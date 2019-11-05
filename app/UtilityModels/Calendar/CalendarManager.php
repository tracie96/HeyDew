<?php


namespace App\UtilityModels\Calendar;


use App\PeexooCalendar;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class CalendarManager
{

    public function addDate(int $user_id,string $start_date,string $end_date,string $description,string $parent_object,int $parent_object_id){
        //does user have any busy day within the start to end date
        $calendar_events=$this->getUserCalendarEvents($user_id,$start_date,$end_date,2);

         if(count($calendar_events)>0){
            throw new \Exception('Calendar has events within the selected dates',400);
         }

         $new_calendar_input=new PeexooCalendar([
             'user_id'=>$user_id,
             'start_date'=>$start_date,
             'end_date'=>$end_date,'description'=>$description,'parent_object'=>$parent_object,'parent_object_id'=>$parent_object_id
         ]);

         if(!$new_calendar_input->save()){
            throw new \Exception('Failed to add Calendar Event',400);
         }

         return $new_calendar_input;
    }


    public function getUserCalendarEvents(int $user_id,string $startDate,string $endDate,int $limit){
        //Get all events date have between start and end dates
        $calendar_events=PeexooCalendar::select()
            ->whereDate('start_date','>=',$startDate)
            ->whereDate('end_date','<=',$endDate)
            ->where(['user_id'=>$user_id])
            ->limit($limit)
            ->get();
        return $calendar_events;
    }
    
    public function isValidDate(string $date){

    }
}