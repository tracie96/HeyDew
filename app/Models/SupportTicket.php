<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    //
    static $SUPPORT_TICKET_STATE_CLOSED='';
    static $SUPPORT_TICKET_STATE_OPEN='';
    static $SUPPORT_TICKET_STATE_IN_PROGRESS='';

    protected $fillable=['token','title','ticket_type','department_id','user_id','description','severity_level','meta_data','archived'];

    //meta_data can be browser_type, os_type, os version, location, e.t.c
    public static function createSupportTicket($token,$title,$ticket_type,$department_id,$user_id,$description,$severity_level,$meta_data){
        $token_exists=SupportTicket::where('token',$token)->first();
        if($token==null){//Support ticket with null token is not accepted
           return false;
        }
        if($token_exists!=null){//Support ticket with token already exists
           return false;
        }
        $support_ticket=new SupportTicket(['token','title','ticket_type','department_id','user_id','description','severity_level','meta_data','archived']);
        return $support_ticket->save();
    }

    public static function updateSupportTicket($ticket_id,$title,$ticket_type,$department_id,$user_id,$description,$severity_level,$meta_data){
        //Can a user update title of an already created support ticket
        $update_params=[];
        if($title!=null){
            $update_params['title']=$title;
        }
        $support_ticket=SupportTicket::where('id',$ticket_id)->update($update_params);
    }

    public static function getUserSupportTicket($user_id,$start,$count,$sort){
        $support_tickets=SupportTicket::where('user_id',$user_id)->orderBy('id',$sort)->offset($start)->limit($count)->get();
        return $support_tickets;
    }

    public static function getSupportTicketsBySeverity($severity_level,$start,$count,$sort){
        $support_tickets=SupportTicket::where('severity_level',$severity_level)->orderBy('id',$sort)->offset($start)->limit($count)->get();
        return $support_tickets;
    }

    public static function getSupportTicketForDepartment($department_id,$start,$count,$sort){
        $support_tickets=SupportTicket::where('department_id',$department_id)->orderBy('id',$sort)->offset($start)->limit($count)->get();
        return $support_tickets;
    }

}
