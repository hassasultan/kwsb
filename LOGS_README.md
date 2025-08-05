# System Logs Management

This document describes the logs management system that has been implemented for tracking user actions and system events.

## Features

### 1. Advanced Filtering
- **User Filter**: Filter logs by specific user
- **User Name Search**: Search by user name (partial match)
- **User Email Search**: Search by user email (partial match)
- **Action Filter**: Filter by action type (Complaint, User, System, Login, Logout)
- **Complaint Number Search**: Search by complaint number (for complaint-related logs)
- **Date Range Filter**: Filter by date range (from/to dates)

### 2. AJAX-Based Interface
- No page refresh required for filtering
- Skeleton loading animation during data loading
- Real-time search and filtering
- Pagination support

### 3. Material Design UI
- Consistent with existing application design
- Responsive layout
- Loading overlays and skeleton animations
- Modern card-based layout

## Routes

### Admin Routes
- `GET /admin/logs-management` - Logs index page
- `GET /admin/logs-management/{id}/detail` - Log detail page

### System User Routes
- `GET /system/logs-management` - Logs index page (for system users)
- `GET /system/logs-management/{id}/detail` - Log detail page (for system users)

## Models

### Logs Model (`app/Models/logs.php`)
```php
class Logs extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'action_id',
        'action_detail',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function complaint()
    {
        return $this->belongsTo(Complaints::class, 'action_id', 'id');
    }
}
```

## Controller

### LogController (`app/Http/Controllers/LogController.php`)
- `index()` - Display logs with filtering
- `detail($id)` - Show detailed log information
- `getLogsData()` - AJAX method for filtered data

## Views

### Index View (`resources/views/pages/logs/index.blade.php`)
- Advanced filtering interface
- AJAX-powered table
- Skeleton loading animations
- Responsive design

### Detail View (`resources/views/pages/logs/detail.blade.php`)
- Comprehensive log information
- User details
- Related complaint information (if applicable)
- Action details

### Partial View (`resources/views/pages/logs/partials/logs-table.blade.php`)
- AJAX-loaded table content
- Pagination support
- Modal for full detail view

## Logging Trait

### Loggable Trait (`app/Traits/Loggable.php`)
Provides easy-to-use methods for logging actions:

```php
// Basic logging
Loggable::logAction('Complaint', $complaintId, 'Complaint created');

// Specific action logging
Loggable::logComplaintAction($complaintId, 'created', 'Complaint created by user');
Loggable::logUserAction($userId, 'updated', 'User profile updated');
Loggable::logSystemAction('maintenance', 'System maintenance started');
Loggable::logLogin('User logged in via web interface');
Loggable::logLogout('User logged out');
```

## Usage Examples

### In Controllers
```php
use App\Traits\Loggable;

class ComplaintController extends Controller
{
    use Loggable;

    public function store(Request $request)
    {
        $complaint = Complaints::create($data);
        
        // Log the action
        $this->logComplaintAction(
            $complaint->id, 
            'created', 
            auth()->user()->name . ' created complaint #' . $complaint->comp_num
        );
    }

    public function update(Request $request, $id)
    {
        $complaint = Complaints::find($id);
        $complaint->update($data);
        
        // Log the action
        $this->logComplaintAction(
            $id, 
            'updated', 
            auth()->user()->name . ' updated complaint #' . $complaint->comp_num
        );
    }
}
```

### In Middleware (for automatic login/logout logging)
```php
// In your authentication middleware or event listeners
Loggable::logLogin('User logged in successfully');
Loggable::logLogout('User logged out');
```

## Database Schema

The logs table should have the following structure:
```sql
CREATE TABLE logs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED,
    action VARCHAR(255) NOT NULL,
    action_id BIGINT UNSIGNED NULL,
    action_detail TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    INDEX idx_user_id (user_id),
    INDEX idx_action (action),
    INDEX idx_action_id (action_id),
    INDEX idx_created_at (created_at)
);
```

## Features Implemented

✅ **Advanced Filtering**: User, action, complaint number, date range filters
✅ **AJAX Interface**: No page refresh required
✅ **Skeleton Loading**: Material design loading animations
✅ **Responsive Design**: Works on all screen sizes
✅ **Relationship Support**: Links to users and complaints
✅ **Detail View**: Comprehensive log information display
✅ **Logging Trait**: Easy-to-use logging methods
✅ **Route Integration**: Properly integrated with existing routes
✅ **Security**: Proper middleware and authentication checks

## Next Steps

1. **Add to Navigation**: Add logs management to the admin navigation menu
2. **Export Functionality**: Add CSV/PDF export for filtered logs
3. **Real-time Updates**: Consider WebSocket integration for real-time log updates
4. **Advanced Analytics**: Add charts and analytics for log data
5. **Automated Cleanup**: Add scheduled cleanup for old log entries

## Security Considerations

- All routes are protected by authentication middleware
- Admin routes require admin privileges
- System user routes require system user privileges
- Log entries are immutable (no edit/delete functionality)
- Sensitive data is not logged (passwords, etc.)

## Performance Considerations

- Pagination implemented to handle large datasets
- Database indexes on frequently queried columns
- AJAX loading to reduce initial page load time
- Skeleton loading for better user experience 
