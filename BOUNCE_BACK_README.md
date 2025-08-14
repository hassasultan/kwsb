# Bounce Back Complaint Functionality

This document describes the bounce back functionality implemented for the complaint module in the KWSB system.

## Overview

The bounce back functionality allows mobile agents and department users to bounce back complaints they are assigned to, effectively removing themselves from the assignment and creating a record of the bounce back action.

## Features

1. **Mobile Agent Bounce Back**: Mobile agents can bounce back complaints via API
2. **Department Bounce Back**: Department users can bounce back complaints via API
3. **Bounce Back History**: Complete history of all bounce back actions
4. **Assignment Removal**: Automatic removal of complaint assignments when bounced back
5. **Web Interface**: Admin can view bounce back details and history

## Database Structure

### New Table: `bounce_back_complaint`

| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary key |
| complaint_id | bigint | Foreign key to complaint table |
| type | enum | 'department' or 'agent' |
| agent_id | bigint | mobile_agent id or department user_id |
| status | enum | 'active' or 'resolved' |
| reason | text | Reason for bounce back |
| bounced_by | bigint | User ID who performed the bounce back |
| bounced_at | timestamp | When the bounce back occurred |
| created_at | timestamp | Record creation time |
| updated_at | timestamp | Record update time |

## API Endpoints

### 1. Bounce Back Complaint
```
POST /api/complaints/bounce-back
```

**Request Body:**
```json
{
    "complaint_id": 123,
    "reason": "Unable to resolve due to technical issues",
    "type": "agent" // or "department"
}
```

**Response:**
```json
{
    "success": "Complaint bounced back successfully",
    "data": {
        "id": 1,
        "complaint_id": 123,
        "type": "agent",
        "agent_id": 456,
        "status": "active",
        "reason": "Unable to resolve due to technical issues",
        "bounced_by": 789,
        "bounced_at": "2024-01-02T10:30:00.000000Z"
    }
}
```

### 2. Get Bounce Back Complaints
```
GET /api/complaints/bounce-back?type=agent
```

**Query Parameters:**
- `type`: 'agent' or 'department' (optional, defaults to 'agent')

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "complaint_id": 123,
            "type": "agent",
            "agent_id": 456,
            "status": "active",
            "reason": "Unable to resolve due to technical issues",
            "bounced_by": 789,
            "bounced_at": "2024-01-02T10:30:00.000000Z",
            "complaint": {
                "id": 123,
                "comp_num": "COMP001",
                "customer_name": "John Doe",
                "town": {"town": "Karachi"},
                "type": {"title": "Water Supply"}
            }
        }
    ]
}
```

## Web Interface

### Bounce Back Status Column
- Added to the complaints index page
- Shows "Bounced Back" with a link to detail page if complaint has been bounced back
- Shows "No" if no bounce back exists

### Bounce Back Index Page
- **Route**: `/admin/bounce-back`
- **View**: `resources/views/pages/bounceBack/index.blade.php`
- **Controller**: `BounceBackController@index`

**Features:**
- Complete list of all bounce back complaints
- Search and filter functionality (by type, status, text search)
- Pagination support
- Assignment functionality for unassigned complaints
- Responsive table with important complaint details

### Bounce Back Detail Page
- **Route**: `/admin/bounce-back/detail/{id}`
- **View**: `resources/views/pages/bounceBack/detail.blade.php`
- **Controller**: `BounceBackController@detail`

**Features:**
- Complete complaint information
- Current assignment details
- Complete bounce back history with reasons and timestamps
- Responsive design with Bootstrap

## Models and Relationships

### BounceBackComplaint Model
```php
class BounceBackComplaint extends Model
{
    protected $table = "bounce_back_complaint";
    
    public function complaint()
    {
        return $this->belongsTo(Complaints::class, 'complaint_id', 'id');
    }
    
    public function mobileAgent()
    {
        return $this->belongsTo(MobileAgent::class, 'agent_id', 'id');
    }
    
    public function departmentUser()
    {
        return $this->belongsTo(User::class, 'agent_id', 'id');
    }
}
```

### Updated Complaints Model
```php
class Complaints extends Model
{
    public function bounceBackComplaints()
    {
        return $this->hasMany(BounceBackComplaint::class, 'complaint_id', 'id');
    }
    
    public function hasBounceBack()
    {
        return $this->bounceBackComplaints()->where('status', 'active')->exists();
    }
}
```

## Business Logic

### Bounce Back Process
1. **Validation**: Check if user is authorized to bounce back the complaint
2. **Record Creation**: Create bounce back record with reason and timestamp
3. **Assignment Removal**: Remove complaint from current agent/department assignment
4. **Logging**: Comprehensive logging of all bounce back actions for audit trail

### Authorization Rules
- Mobile agents can only bounce back complaints assigned to them
- Department users can only bounce back complaints assigned to their department
- Users must be authenticated via API token

## Security Features

- **Authentication Required**: All bounce back operations require valid API token
- **Authorization Check**: Users can only bounce back complaints assigned to them
- **Input Validation**: Request data is validated before processing
- **Audit Logging**: All bounce back actions are logged for compliance

## Logging & Audit Trail

### Comprehensive Logging System
The bounce back functionality includes extensive logging for all operations:

#### **API Operations (Mobile/Department Users)**
- **Bounce Back Action**: Logs when complaints are bounced back with reason and type
- **View Bounce Back List**: Logs when users view their bounce back complaints
- **Format**: `{User Name} has bounced back the complaint. Reason: {Reason} (Type: {Agent/Department})`

#### **Admin Operations (Web Interface)**
- **View Bounce Back List**: Logs when admins view the bounce back complaints list
- **View Bounce Back Details**: Logs when admins view specific bounce back complaint details
- **Load Agents/Departments**: Logs when assignment dropdowns are populated
- **Reassign Complaints**: Logs when bounce back complaints are reassigned to new agents/departments

#### **Log Entry Examples**
```
"John Doe has bounced back the complaint. Reason: Customer not available (Type: Agent)"
"Admin User viewed bounce back complaints list (Admin Panel)"
"Admin User viewed bounce back complaint details for complaint #COMP001"
"Admin User loaded mobile agents list for bounce back assignment"
"Bounce back complaint reassigned to Mobile Agent: John Smith by Admin User"
```

#### **Log Categories**
- **Complaint**: For complaint-related bounce back actions
- **BounceBack**: For admin panel bounce back operations
- **User Tracking**: All actions include user identification and timestamps

## Usage Examples

### Mobile Agent Bouncing Back Complaint
```javascript
// Using fetch API
fetch('/api/complaints/bounce-back', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + token
    },
    body: JSON.stringify({
        complaint_id: 123,
        reason: "Customer not available at location",
        type: "agent"
    })
})
.then(response => response.json())
.then(data => console.log(data));
```

### Department User Bouncing Back Complaint
```javascript
fetch('/api/complaints/bounce-back', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + token
    },
    body: JSON.stringify({
        complaint_id: 123,
        reason: "Requires technical expertise not available in department",
        type: "department"
    })
})
.then(response => response.json())
.then(data => console.log(data));
```

## Web Routes

### Admin Routes
```php
Route::get('/bounce-back', [BounceBackController::class, 'index'])->name('bounce-back.index');
Route::get('/bounce-back/detail/{id}', [BounceBackController::class, 'detail'])->name('bounce-back.detail');
Route::get('/bounce-back/get-agents', [BounceBackController::class, 'getAgents'])->name('bounce-back.get-agents');
Route::get('/bounce-back/get-departments', [BounceBackController::class, 'getDepartments'])->name('bounce-back.get-departments');
Route::post('/bounce-back/assign', [BounceBackController::class, 'assign'])->name('bounce-back.assign');
```

## Migration

```bash
php artisan migrate
```

This will create the `bounce_back_complaint` table with proper foreign key constraints and indexes.

## Testing

Basic tests are included in `tests/Feature/BounceBackTest.php`. Run tests with:

```bash
php artisan test --filter=BounceBackTest
```

## Future Enhancements

1. **Bounce Back Reasons**: Predefined list of common bounce back reasons
2. **Auto Reassignment**: Automatic reassignment to other agents/departments
3. **Escalation**: Automatic escalation for complaints bounced back multiple times
4. **Notifications**: Notify supervisors when complaints are bounced back
5. **Analytics**: Reports on bounce back patterns and reasons

## Complaint Logs & Timeline Feature

### Overview
A comprehensive logs and timeline view for each complaint that shows the complete audit trail from creation to resolution.

### Features
- **Beautiful Timeline UI**: Alternating left-right timeline layout with color-coded markers
- **Complete Activity Logs**: All complaint-related activities with timestamps
- **Bounce Back Integration**: Bounce back actions integrated into the main timeline
- **Statistics Dashboard**: Key metrics including total activities, complaint age, duration, and bounce back count
- **Responsive Design**: Mobile-friendly timeline that adapts to different screen sizes

### Access
- **Route**: `/admin/compaints-management/logs/{id}`
- **View**: `resources/views/pages/complaints/logs.blade.php`
- **Controller Method**: `ComplaintController@logs`

### Timeline Markers
- **Complaint**: Green marker for complaint-related actions
- **BounceBack**: Orange marker for bounce back actions
- **User**: Blue marker for user-related actions
- **Agent**: Purple marker for agent-related actions
- **Default**: Gray marker for other actions

### Statistics Cards
- **Total Activities**: Count of all logged actions
- **Complaint Age**: How long the complaint has existed
- **Duration**: Time from creation to resolution (or current time)
- **Bounce Backs**: Number of times the complaint was bounced back

## Support

For questions or issues related to the bounce back functionality, please refer to the development team or create an issue in the project repository. 
