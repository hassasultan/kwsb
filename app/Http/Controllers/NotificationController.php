<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\MobileAgent;
use App\Models\Town;
use App\Models\ComplaintType;
use App\Services\FirebaseNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    protected $firebaseService;

    public function __construct(FirebaseNotificationService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }

    /**
     * Display a listing of notifications
     */
    public function index()
    {
        $notifications = Notification::with(['sender', 'recipient'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('pages.notifications.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new notification
     */
    public function create()
    {
        $agents = MobileAgent::with('user')->orderBy('id', 'asc')->get();
        $towns = Town::orderBy('town', 'asc')->get();
        $types = ComplaintType::orderBy('title', 'asc')->get();

        return view('pages.notifications.create', compact('agents', 'towns', 'types'));
    }

    /**
     * Store a newly created notification
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'type' => 'required|in:general,urgent,reminder',
            'recipient_type' => 'required|in:all,agent,town,type',
            'recipient_id' => 'nullable|required_if:recipient_type,agent,town,type',
            'data' => 'nullable|array'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $result = null;

            switch ($request->recipient_type) {
                case 'all':
                    $result = $this->firebaseService->sendToAllAgents(
                        $request->title,
                        $request->body,
                        $request->data ?? [],
                        Auth::id()
                    );
                    break;

                case 'agent':
                    $agent = MobileAgent::with('user')->find($request->recipient_id);
                    if ($agent && $agent->user->device_token) {
                        $result = $this->firebaseService->sendNotification(
                            $agent->user->device_token,
                            $request->title,
                            $request->body,
                            $request->data ?? [],
                            $request->type,
                            $agent->id,
                            'agent',
                            Auth::id()
                        );
                    }
                    break;

                case 'town':
                    $result = $this->firebaseService->sendToAgentsByTown(
                        $request->recipient_id,
                        $request->title,
                        $request->body,
                        $request->data ?? [],
                        Auth::id()
                    );
                    break;

                case 'type':
                    $result = $this->firebaseService->sendToAgentsByType(
                        $request->recipient_id,
                        $request->title,
                        $request->body,
                        $request->data ?? [],
                        Auth::id()
                    );
                    break;
            }

            if ($result && $result['success_count'] > 0) {
                return redirect()->route('admin.notification.index')
                    ->with('success', "Notification sent successfully to {$result['success_count']} recipients");
            } else {
                return back()->with('error', 'No recipients found with device tokens');
            }

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send notification: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified notification
     */
    public function show($id)
    {
        $notification = Notification::with(['sender', 'recipient'])->findOrFail($id);
        return view('pages.notifications.show', compact('notification'));
    }

    /**
     * Show the form for editing the specified notification
     */
    public function edit($id)
    {
        $notification = Notification::findOrFail($id);
        $agents = MobileAgent::with('user')->get();
        $towns = Town::all();
        $types = ComplaintType::all();

        return view('pages.notifications.edit', compact('notification', 'agents', 'towns', 'types'));
    }

    /**
     * Update the specified notification
     */
    public function update(Request $request, $id)
    {
        $notification = Notification::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'type' => 'required|in:general,urgent,reminder',
            'recipient_type' => 'required|in:all,agent,town,type',
            'recipient_id' => 'nullable|required_if:recipient_type,agent,town,type',
            'data' => 'nullable|array'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $notification->update($request->only(['title', 'body', 'type', 'recipient_type', 'recipient_id', 'data']));

        return redirect()->route('admin.notification.index')
            ->with('success', 'Notification updated successfully');
    }

    /**
     * Remove the specified notification
     */
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return redirect()->route('admin.notification.index')
            ->with('success', 'Notification deleted successfully');
    }

    /**
     * Send test notification
     */
    public function sendTest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'recipient_type' => 'required|in:all,agent,town,type',
            'recipient_id' => 'nullable|required_if:recipient_type,agent,town,type'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        try {
            $result = null;

            switch ($request->recipient_type) {
                case 'all':
                    $result = $this->firebaseService->sendToAllAgents(
                        $request->title,
                        $request->body,
                        ['test' => true],
                        Auth::id()
                    );
                    break;

                case 'agent':
                    $agent = MobileAgent::with('user')->find($request->recipient_id);
                    if ($agent && $agent->user->device_token) {
                        $result = $this->firebaseService->sendNotification(
                            $agent->user->device_token,
                            $request->title,
                            $request->body,
                            ['test' => true],
                            'general',
                            $agent->id,
                            'agent',
                            Auth::id()
                        );
                    }
                    break;

                case 'town':
                    $result = $this->firebaseService->sendToAgentsByTown(
                        $request->recipient_id,
                        $request->title,
                        $request->body,
                        ['test' => true],
                        Auth::id()
                    );
                    break;

                case 'type':
                    $result = $this->firebaseService->sendToAgentsByType(
                        $request->recipient_id,
                        $request->title,
                        $request->body,
                        ['test' => true],
                        Auth::id()
                    );
                    break;
            }

            if ($result && $result['success_count'] > 0) {
                return response()->json([
                    'success' => true,
                    'message' => "Test notification sent successfully to {$result['success_count']} recipients",
                    'result' => $result
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No recipients found with device tokens'
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send test notification: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Get notification statistics
     */
    public function statistics()
    {
        $stats = [
            'total' => Notification::count(),
            'sent' => Notification::where('status', 'sent')->count(),
            'delivered' => Notification::where('status', 'delivered')->count(),
            'failed' => Notification::where('status', 'failed')->count(),
            'by_type' => Notification::selectRaw('type, COUNT(*) as count')
                ->groupBy('type')
                ->get(),
            'recent' => Notification::with(['sender', 'recipient'])
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get()
        ];

        return view('pages.notifications.statistics', compact('stats'));
    }
}
