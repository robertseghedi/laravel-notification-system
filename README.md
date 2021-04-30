# Laravel Notification System
 One of the most practical user-notification open-source systems.
 
 This is a fresh Laravel plugin which shows you an easier way to send encrypted notifications to your users.
 
 ## Instalation
 First, you have to install the package using composer in your project root folder:
 ```
 composer require robertseghedi/laravel-notification-system
 ```
 Then, you have to add the provider to your ```config/app.php``` like that:
 ```php
 // your providers

RobertSeghedi\LNS\LNSProvider::class,
 ```
 Run the migrate command in order to add the notifications table
  ```
  php artisan migrate
   ```
## Information
 
| Command name | What it does |
| --- | --- |
| LNS::notify($user, $string) | Sends the string to the mentioned user|
| LNS::notifications($user, $results = 'all' or number) | Fetches the mentioned user's notifications based on the criteria|
| LNS::delete($id) | Deletes the mentioned notification|
| LNS::read_all($user) | Changes all the user's notifications status to 1|
| LNS::read_notification($id) | Changes the mentioned notification status to 1|
| LNS::change_notification_user($id, $new_user) | Changes the notification's ownership to the mentioned user|
| LNS::delete_all($user) | Deletes all the user's notifications|
   
## Usage

Now you can start using the package.

### 1. Include it in your controller

 ```php
use RobertSeghedi\LNS\Models\LNS;
  ```
   
### 2. Start using the tools

```php
public function monday_alert($user = null)
{
    $notification = LNS::notify($user, "Your package will arrive on Monday.");
    if($notification) return redirect()->back()->with('success', 'Notification sent.');
}
```

```php
public function delete($notification)
{
    $deletion = LNS::delete($notification);
    if($deletion) return redirect()->back();
}
```
### 3. Send notifications to your users

Follow this package for future updates
