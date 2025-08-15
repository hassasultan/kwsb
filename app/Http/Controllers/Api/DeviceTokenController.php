<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\MobileAgent;

class DeviceTokenController extends Controller
{
    /**
     * Save device token for authenticated user
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'device_token' => 'required|string',
            'platform' => 'nullable|string|in:android,ios,web'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = auth('api')->user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated'
                ], 401);
            }

            // Update user's device token
            $user->update([
                'device_token' => $request->device_token
            ]);

            // If user is an agent, also update MobileAgent table
            if ($user->agent) {
                $user->agent->update([
                    'device_token' => $request->device_token
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Device token saved successfully',
                'data' => [
                    'user_id' => $user->id,
                    'device_token' => $request->device_token,
                    'platform' => $request->platform ?? 'unknown'
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save device token',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove device token for authenticated user
     */
    public function destroy(Request $request)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated'
                ], 401);
            }

            // Remove device token from user
            $user->update([
                'device_token' => null
            ]);

            // If user is an agent, also remove from MobileAgent table
            if ($user->agent) {
                $user->agent->update([
                    'device_token' => null
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Device token removed successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove device token',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get device token status for authenticated user
     */
    public function show()
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated'
                ], 401);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'user_id' => $user->id,
                    'has_device_token' => !empty($user->device_token),
                    'device_token' => $user->device_token,
                    'is_agent' => $user->agent ? true : false
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get device token status',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
