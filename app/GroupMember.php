<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\UpdateUser;

class GroupMember extends Model
{
    protected $fillable = ['group_id','user_id','status'];
    protected $primaryKey = ['user_id', 'group_id'];
    public $incrementing = false;
    
    protected $dispatchesEvents = ['saved'=>UpdateUser::class];

    public function group() {
      return $this->belongsTo(Group::class);
    }
    public function user() {
      return $this->belongsTo(User::class);
    }

    public function bulkuser() {
      return $this->belongsToMany(BulkUser::class, 'user_id');
    }

    public static function remove($group_id, $user_id) {
      $ret = GroupMember::where('group_id',$group_id)->where('user_id',$user_id)->delete();
      event(new UpdateUser((Object)['user_id'=>$user_id]));
      return $ret;
    }
}