<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    //
    private static $JOB_STATUS_OPEN=''; //No photographer has taken it
    private static $JOB_STATUS_OCCUPIED=''; //A photographer has taken it
    private static $JOB_STATUS_CLOSED=''; //The job has been concluded

    protected $fillable=['title','user_id','description','job_type','photographer_id','state'];

    public static function addJob($title,$user_id,$description,$photographer_id,$state){
        $job=new Jobs([
            'title'=>$title,
            'user_id'=>$user_id,
            'description'=>$description,
            'photographer_id'=>$photographer_id,
            'state'=>$state
        ]);
        return $job->save();
    }

    public static function getOpenJobs($job_type,$start,$count,$sort){
        $jobs=Jobs::where(['state'=>'open','job_type'=>$job_type])->get();
        return $jobs;
    }

    public static function getClosedJobs($job_type,$start,$count,$sort){
        $jobs=Jobs::where(['state'=>'close','job_type'=>$job_type])->get();
        return $jobs;
    }

    public static function getOccupiedJobs($job_type,$start,$count,$sort){
        $jobs=Jobs::where(['state'=>'occupied','job_type'=>$job_type])->get();
        return $jobs;
    }

    public static function getPhotographerJobs($photographer_id,$start,$count,$sort){
        $jobs=Jobs::where(['photographer_id'=>$photographer_id])->get();
        return $jobs;
    }


    public static function getJobsPostedByUser($user_id,$start,$count,$sort){
        $jobs=Jobs::where(['user_id'=>$user_id])->get();
        return $jobs;
    }

    public static function getJobsByType($job_type,$start,$count,$sort){
        $jobs=Jobs::where(['job_type'=>$job_type])->get();
        return $jobs;
    }



}
