<?php

class Tracker extends CI_Controller {


    /**
     * @author Marie-Lyse Briffaud
     * @date 16/12/2015
     * @param $pages : name of the page to display
	 * @param $id : tracking 
     * incrémente le compteur de la page dans le fichier json et redirige vers l'url normale
     */    
	public function view($page = 'index', $id=0){
        if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php')){
                //Whoops, we don't have a page for that!
                show_404();
            
        }
		else{
			$this->load->helper('url');
			$fileTracker = $_SERVER['DOCUMENT_ROOT']."/tracker.json";
			if (file_exists($fileTracker)){
				$json = file_get_contents($fileTracker);
				//on récupère un tableau associatif
				$json = json_decode($json, $assoc = true);
			}
			else{
				$json = array();
			}
			
			if (isset($json[$id][$page])){
				$json[$id][$page]++;
			}
			else{
				$json[$id][$page] = 1;
			}
			file_put_contents($fileTracker,json_encode($json));
			header("Location: ".base_url().$page.".html");
		}

	}
}
?>