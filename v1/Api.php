<?php 

	require_once '../includes/DbOperation.php';

	function isTheseParametersAvailable($params){
	
		$available = true; 
		$missingparams = ""; 
		
		foreach($params as $param){
			if(!isset($_POST[$param]) || strlen($_POST[$param])<=0){
				$available = false; 
				$missingparams = $missingparams . ", " . $param; 
			}
		}
		
		
		if(!$available){
			$response = array(); 
			$response['error'] = true; 
			$response['message'] = 'Parameters ' . substr($missingparams, 1, strlen($missingparams)) . ' missing';
			
		
			echo json_encode($response);
			
		
			die();
		}
	}
	
	$response = array();
	
	
			if(isset($_POST['createhero']))
			{
				isTheseParametersAvailable(array('name','realname','rating','teamaffiliation'));
				
				$db = new DbOperation();
				
				$result = $db->createHero($_POST['name'], $_POST['realname'], $_POST['rating'], $_POST['teamaffiliation']);
				
				if($result){
					
					$response['error'] = false; 

					
					$response['message'] = 'Heroi adicionado com sucesso';

					
					$response['heroes'] = $db->getHeroes();
				}else{

					
					$response['error'] = true; 

				
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
			}
			
			else if(isset($_POST['getheroes']))
			{
				$db = new DbOperation();
				$response['error'] = false; 
				$response['message'] = 'Pedido concluido com sucesso';
				$response['heroes'] = $db->getHeroes();
			}
			
			
		
			else if(isset($_POST['updatehero'])){

				isTheseParametersAvailable(array('name','realname','rating','teamaffiliation'));

				$db = new DbOperation();
				$result = $db->updateHero($_POST['id'], $_POST['name'], $_POST['realname'], $_POST['rating'], $_POST['teamaffiliation']);
				
				if($result){
					$response['error'] = false; 
					$response['message'] = 'Heroi atualizado com sucesso';
					$response['heroes'] = $db->getHeroes();
				}else{
					$response['error'] = true; 
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
			}
			
			
			else if(isset($_POST['deletehero'])){

				$id = $_POST['id'];

				if(isset($id)){
					$db = new DbOperation();

					if($db->deleteHero($id)){
						$response['error'] = false; 
						$response['message'] = 'Heroi excluido com sucesso';
						$response['heroes'] = $db->getHeroes();
					}else{
						$response['error'] = true; 
						$response['message'] = 'Algum erro ocorreu por favor tente novamente';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Não foi possivel deletar, forneça um id por favor';
				}
			} 
			else{
		 
				$response['error'] = true; 
				$response['message'] = 'Chamada de API invalida';
		}
	echo json_encode($response);

	?> 