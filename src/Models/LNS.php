<?php

namespace RobertSeghedi\LNS\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory, Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt, Illuminate\Contracts\Encryption\DecryptException;
use RobertSeghedi\LNS\Models\Notification;

class LNS extends Model
{
    public static function notify($user, $string, $type = 1)
    {
        $notification = new Notification();
        $notification->user = $user;
        $notification->content = Crypt::encrypt($string);
        $notification->type = $type;
        $save_notification = $notification->save();
        if($save_notification) return json_encode(['success' => 1]);
    }
    public static function notifications($user, $results = 'all')
    {
        Cache::forget("notifications_$user");
        if($results != 'all')
        {
            $ao = Cache::remember("notifications_$user", 1801, function () use ($user, $results) {
                $ao = Notification::where('user', $user)->take($results)->get()->lazy()->each(function($a){
                    $a->text = Crypt::decrypt($a->content);
                });
                return (object) $ao;
            });
        }
        elseif($results == 'all')
        {
            $ao = Cache::remember("notifications_$user", 1801, function () use ($user) {
                $ao = Notification::where('user', $user)->get()->lazy()->each(function($a){
                    $a->text = Crypt::decrypt($a->content);
                });
                return (object) $ao;
            });
        }
        return json_encode($ao);
    }
    public static function delete_notification($id)
    {
        $deletion = Notification::where('id', $id)->delete();
        if($deletion) return json_encode(['success' => 1]);
    }
    public static function read_all($user)
    {
        $status_changing = Notification::where('user', $user)->update(['status' => 1]);
        if($status_changing) return json_encode(['success' => 1]);
    }
    public static function read_notification($id)
    {
        $status_changing = Notification::where('id', $id)->update(['status' => 1]);
        if($status_changing) return json_encode(['success' => 1]);
    }
    public static function change_notification_user($id, $new_user)
    {
        $owner_changing = Notification::where('id', $id)->update(['user' => $new_user]);
        if($owner_changing) return json_encode(['success' => 1]);
    }
    public static function delete_user_notifications($user)
    {
        $deletion = Notification::where('user', $user)->delete();
        if($deletion) return json_encode(['success' => 1]);
    }
}
