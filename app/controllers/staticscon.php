<?php
class Staticscon extends Controller{

		public function noMethod()
		{
			$static=$this->model('Statics');
   	      $data=(object)[];
		   if(Input::get('resident')){
           $stat=$static->getResidentSR();
           $labels=array();
           $datar=array();
           $data->resident=array();
           foreach ($stat as $s ) {
             array_push($labels, $s->ownrent);
             array_push($datar, $s->number);
           }
           array_push($data->resident, $labels);
           array_push($data->resident, $datar);
         
      	 }
         if(Input::get('reservation')){
           $statGR=$static->getFacilitySR('Guest Room');
           $statPR=$static->getFacilitySR('Party Room');
           $statEL=$static->getFacilitySR('Elevator');
           $labelsGR=array();
           $datarGR=array();
           $labelsPR=array();
           $datarPR=array();
           $labelsEL=array();
           $datarEL=array();
           $data->groom=array();
           $data->proom=array();
           $data->elevator=array();

           foreach ($statGR as $s ) {
             array_push($labelsGR, $s->status);
             array_push($datarGR, $s->statusnum);
           }
           array_push($data->groom, $labelsGR);
           array_push($data->groom, $datarGR);

            foreach ($statPR as $s ) {
             array_push($labelsPR, $s->status);
             array_push($datarPR, $s->statusnum);
           }
           array_push($data->proom, $labelsPR);
           array_push($data->proom, $datarPR);

           foreach ($statEL as $s ) {
             array_push($labelsEL, $s->status);
             array_push($datarEL, $s->statusnum);
           }
           array_push($data->elevator, $labelsEL);
           array_push($data->elevator, $datarEL);

         }
      	 
             echo json_encode($data);
           
		}

}
