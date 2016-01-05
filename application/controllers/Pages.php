<?php

class Pages extends CI_Controller {


    /**
     * @author Marie-Lyse Briffaud
     * @date 15/09/2015
     * @param $pages : name of the page to display
     * 
     */    
	public function view($page = 'index'){
        //$this->output->cache(525600);/*cache d'une année en minutes*/
        if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php')){
                // Whoops, we don't have a page for that!
                show_404();
        }
		
		$data['menu']=[
			"rang" => 1,
			"Evènements" => [
				"rang" => 2,
				'Carte' => 'carte.html', 
				'Agenda' => 'agenda.html'
			],
			"Participer" => [
				"rang" => 2,
				'Session e-commerce décembre' => 'getup-prestashop-decembre.html',
				'Session site vitrine janvier' => 'getup-vitrine-janvier.html',
				'Session e-commerce prestige mars' => 'getup-ecommerce-prestige-mars.html',
				'Suggérer un GetUP!' => 'suggerersession.html',
				'Améliorer GetUP!' => 'questionnaire.html',
				
			],
				
			"Organiser" =>  [
				"rang" => 2,
				'Créer une session' => 'creersession.html', 
				'Intervenir sur une session' => 'postuler.html'],
			"En savoir plus" => [
				"rang" => 2,
				'La méthode GetUP!' => 'wiki/',
				'Suivez notre aventure' => 'https://medium.com/@mickaelruau', 
				'Ils parlent de nous' => [
					"rang" => 3,
					"url" => 'liens.html',
					'Réussir son entreprise' => 'http://reussir-son-entreprise.fr/1-semaine-pour-donner-vie-a-votre-projet-avec-getup/',
					'Coup de Pouce 49' => 'http://www.coupdepouce49.fr/blog/2015/09/14/lancez-votre-entreprise-avec-getup/',
					'Startupeers' => 'http://startupeers.co/1-semaine-donner-vie-a-projet-getup/',
				],
			],
		];
		
		$title = [ 
			'index' 					=> 'CodeCamp pour entrepreneurs',
			'agenda' 					=> 'Agenda des évènements',
			'carte' 					=> 'Carte des évènements',
			'mentions' 					=> 'Mentions légales',
			'plan' 						=> 'Plan du site',
			'suggerersession' 			=> 'Suggérer une session',
			'creersession' 				=> 'Créer une session',
			'getup-prestashop-decembre' => 'CodeCamp pour entrepreneurs',
			'getup-ecommerce-prestige-mars' => 'CodeCamp pour entrepreneurs',
			'getup-vitrine-janvier' 	=> 'CodeCamp pour entrepreneurs',
			'questionnaire' 			=> 'Améliorer GetUP',
			'postuler' 					=> 'Intervenir sur une session',
		];
		
		$data['title'] = $title[$page];

        $this->load->view('templates/header',$data);
        $this->load->view('pages/'.$page);
        $this->load->view('templates/footer');
	}
	
	
	public function edit($page = 'index'){
	
		$data['page'] = $page;
		$data['filePath'] = $_SERVER['DOCUMENT_ROOT'].'/application/views/pages/'.$page.'.php';
		$data['save'] = false;
		$data['edit'] = true;
			
		//formulaire
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('code', 'Code', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{			
			$this->load->view('saveform/edit',$data);

		}
		else
		{
			/* à faire : effacer le cache une fois le fichier modifié*/
			file_put_contents($data['filePath'],$this->input->post('code'));
			//file_put_contents($data['filePath'],$_POST['code']);

			$data['save'] = true;
			$this->load->view('saveform/edit',$data);
		}
	}
}
?>