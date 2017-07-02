<?php
namespace mercadolivreAPI;
/**
 * Mercado Livre API v1.
 *
 * TERMS OF USE:
 * - This code is in no way affiliated with, authorized, maintained, sponsored
 *   or endorsed by Mercado Livre or any of its affiliates or subsidiaries. This is
 *   an independent and unofficial API. Use at your own risk.
 * - We do NOT support or tolerate anyone who wants to use this API to send spam
 *   or commit other online crimes.
 *
 */
class MercadoLivre
{

/**
	* config to all requests
	*
	* @var array
	**/
	private static $cfg = [];

	/**
	* Login url
	*
	* @var string
	**/
	protected $_loginUrl = 'https://auth.mercadolivre.com.br/authorization';

	/**
	* Rest API
	*
	* @var string
	**/
	protected $_api = 'https://api.mercadolibre.com';

	/**
	* @var array
	*		   client_id
	*		   client_secret
	*		   redirect_uri
	*		   response_type
	*		   scope
	*
	* @var string
	*		   token
	**/
	public function __construct(
        $data = null)
	{
		if(empty($data))
			throw new Exception("Empty data in __construct");

		if(is_array($data)){
			self::$cfg['redirect_uri'] 	    = $data['redirect_uri'];
			self::$cfg['client_id'] 	    = $data['client_id'];
			self::$cfg['response_type']     = $data['response_type'];

			if(isset($data['state'])) 
				self::$cfg['state'] 	    = $data['state'];

			if(isset($data['client_secret'])) 
				self::$cfg['client_secret'] = $data['client_secret'];			

		} else{
			self::$cfg['token'] = 'access_token='.$data;
		}
    }


    /**
	* 
	* Get a login url to send your user
	* in $scope include offline_access to get indefined token
	*
	* @return string 	
	*
	**/
    public function getLoginUrl()
	{
		$endpoint = $this->_loginUrl . '?';
		return $endpoint . http_build_query(self::$cfg);
	}

	/**
	* 
	* Get Information related to your User Group
	* @return array 	
	*
	**/
    public function getMe($params)
	{
		$endpoint = $this->_api . '/users/me?'.self::$cfg['token'];

		return $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();
	}

    /**
    * 
    * Get user's public information
    * @var array
    *          user_id
    *
    * @return array     
    *
    **/
    public function getUsePublic($params)
    {
        $endpoint = $this->_api . '/users/'.self::$params['user_id'];

        return $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();
    }

    /**
    * 
    * Get private information from a user who has accepted the use app
    * @var array
    *          user_id
    *
    * @return array     
    *
    **/
    public function getUsePrivate($params)
    {
        $endpoint = $this->_api . '/users/'.self::$params['user_id'].'?'.self::$cfg['token'];

        return $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();
    }

    /**
    * 
    * Get Promotional packages are packages with classified publications of car dealerships
    *
    * @return array     
    *
    **/
    public function getPromotionalPackages()
    {
        $endpoint = $this->_api . '/categories/MLB1743/classifieds_promotion_packs';

        return $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();
    }

    /**
    * 
    * Get Promotional packeges promotion contracted by user
    *
    * @return array     
    *
    **/
    public function getPromotionalPackagesByUser()
    {
        $endpoint = $this->_api . '/users/'.$params['user_id'].'/classifieds_promotion_packs?'.self::$cfg['token'];

        return $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();
    }

    /**
    * 
    * Post Promotional packages are packages with classified publications of car dealerships
    *
    * @var array
    *      user_id
    *
    * @return array     
    *
    **/
    public function postPromotionalPackages($params)
    {
        $endpoint = $this->_api . '/users/'.$params['user_id'].'/classifieds_promotion_packs&'.self::$cfg['token'];

        return $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->addHeader('Content-type', 'application/json')
            ->addPost('categ_id', 'MLB1743')
            ->addPost('promotion_pack_id', $params['promotion_pack_id'])
            ->addPost('engagement_type', $params['engagement_type'])
            ->addPost('status', 'active')
            ->getResponse();
    }

    /**
    * 
    * Active Promotional packages are packages with classified publications of car dealerships
    * @var array
    *      user_promotion_pack_id
    *      user_id
    *
    * @return array     
    *
    **/
    public function activePromotionalPackages($params)
    {
        $endpoint = $this->_api . '/users/'.$params['user_id'].'/classifieds_promotion_packs/'.$params['user_promotion_pack_id'].'?'.self::$cfg['token'];

        return $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->addPut('status', 'active')
            ->getResponse();
    }

    /**
    * 
    * Active Promotional packages are packages with classified publications of car dealerships
    *
    * @return array     
    *
    **/
    public function getListingTypes()
    {
        $endpoint = $this->_api . '/sites/MLB/listing_types';

        return $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->addPut('status', 'active')
            ->getResponse();
    }

    /**
    * 
    * Disable Promotional packages are packages with classified publications of car dealerships
    * @var array
    *      user_id
    *      user_promotion_pack_id
    *
    * @return array     
    *
    **/
    public function disablePromotionalPackages($params)
    {
        $endpoint = $this->_api . '/users/'.$params['user_id'].'/classifieds_promotion_packs/'.$params['user_promotion_pack_id'].'?'.self::$cfg['token'];

        return $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->addPut('status', 'finished')
            ->getResponse();
    }

    /**
    * 
    * Disable Promotional packages are packages with classified publications of car dealerships
    * @var array
    *      id_product
    *
    * @return array     
    *
    **/
    public function getDeal($params)
    {
        $endpoint = $this->_api . '/items/'.$params['id_product'];

        return $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();       
    }

    /**
    * 
    * Disable Promotional packages are packages with classified publications of car dealerships
    *
    * @return array     
    *
    **/
    public function getCharacteristics(){
        $endpoint = $this->_api .'MLB118852/attributes';
        return $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();         
    }


    /**
    * 
    * Disable Promotional packages are packages with classified publications of car dealerships
    *
    * @var array
    *      id_category
    *
    * @return array     
    *
    **/
    public function getAttributes($params)
    {
        $endpoint = $this->_api . '/categories/'.$params['id_category'].'/technical_specifications';
        $attributes = array();
        $response = $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();
       
        $response = $response['body']['specifications'];
            foreach ($response as $key => $content) {
                $aux = $content['content'];
                foreach ($aux as $key => $value) {
                    if($value['value_type']=='boolean'){
                        array_push($attributes, $value['id']);
                    }
                }
            }
        return $attributes;
    }

    /**
    * 
    * Disable Promotional packages are packages with classified publications of car dealerships
    *
    * @return array     
    *
    **/
    public function getFuelType()
    {
        $endpoint = $this->_api . '/categories/MLB118852/attributes';
        $response = $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();
        return $response['body'][6]['values'];
    }

    /**
    * 
    * Disable Promotional packages are packages with classified publications of car dealerships
    *
    * @return array     
    *
    **/
    public function getStates(){
        $endpoint = $this->_api . '/countries/BR';
        $response = $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();
        return $response['states'];
    }


    /**
    * 
    * Disable Promotional packages are packages with classified publications of car dealerships
    * @var array
    *      id_state
    *
    * @return array     
    *
    **/
    public function getCity($params)
    {
        $endpoint = $this->_api.'/states/'.$params['id_state'];
        $response = $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();
        return $response['cities'];
    }

    /**
    * 
    * GET the amount of visits for a user in a period of time 
    * @var array
    *      id_user
    *      date_from
    *      date_to
    *
    * @return array     
    *
    **/
    public function getUserVisitsItems($params)
    {
        $endpoint = $this->_api.'/users/'.$params['id_user'].'/items_visits/?date_from='.$params['date_from'].'&date_to='.$params['date_to'];
        $response = $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();
        return $response;
    }

    /**
    * 
    * GET total visits to item
    * @var array
    *      id_item
    *      date_from
    *      date_to 
    *
    * @return array     
    *
    **/
    public function getVisitsItem($params)
    {
        $endpoint = $this->_api.'/items/'.$params['id_item'].'/visits/?date_from='.$params['date_from'].'&date_to='.$params['date_to'];
        $response = $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();
        return $response;
    }

    /**
    * 
    * GET when an item has been finalized and wich should be redirect
    *
    * @var array
    *      id_item
    *
    * @return array     
    *
    **/
    public function getFinalizedItemAndRedirect($params)
    {
        $endpoint = $this->_api.'/items/'.$params['id_item'].'redirect';
        $response = $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();
        return $response;
    }

    /**
    * 
    * GET the number of questions that a item received 
    *
    * @var array
    *      date_from
    *      date_to
    *
    * @return array     
    *
    **/
    public function getQuestionsItem($params)
    {
        $endpoint = $this->_api.'/items/'.$params['id_item'].'questions?data_from='.$params['date_from'].'&date_to='.$params['date_to'];
        $response = $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();
        return $response;
    }

    /**
    * 
    * GET the details of the questions tha a particular item received
    *
    * @var array
    *      id_item
    *      date_from
    *      date_to
    *      limit
    *      offset
    *
    * @return array     
    *
    **/
    public function getQuestionsItemParticular($params)
    {

        $endpoint = $this->_api.'/items/'.$params['id_item'].'contacts/questions/search?data_from='.$params['date_from'].'&date_to='.$params['date_to'].'limit='.$params['limit'].'&offset='.$params['offset'];

        $response = $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();
        return $response;
    }

    /**
    * 
    * GET the number of clicks on "view phone" that an item received
    *
    * @var array
    *      id_item
    *      date_from
    *      date_to
    *
    * @return array     
    *
    **/
    public function getViewPhoneItem($params)
    {
        $endpoint = $this->_api.'/items/'.$params['id_item'].'contacts/questions/search?data_from='.$params['date_from'].'&date_to='.$params['date_to'];
        $response = $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();
        return $response;
    }

    /**
    * 
    * GET the number of clicks on "view phone" that an item received at intervals by the "hour" or "day"
    *
    * @var array
    *      id_item
    *      last
    *      unit
    *
    * @return array     
    *
    **/
    public function getViewPhoneItemIntervals($params)
    {
        $endpoint = $this->_api.'/items/'.$params['id_item'].'contacts/phone_views/time_window?last='.$params['last'].'&unit='.$params['unit'];
        $response = $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();
        return $response;
    }

    /**
    * 
    * GET the total amount of Questions has a particular item in a date range 
    *
    * @var array
    *      id_item
    *      date_from
    *      date_to
    *
    * @return array     
    *
    **/
    public function getQuestionsItemContacts($params)
    {
        $endpoint = $this->_api.'/items/'.$params['id_item'].'contacts/questions?date_from='.$params['date_from'].'&date_to='.$params['date_to'];
        $response = $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();
        return $response;
    }

    /**
    * 
    * GET the Questions on a particular item in a specific time window  
    *
    * @var array
    *      id_item
    *      last
    *      unit
    *
    * @return array     
    *
    **/
    public function getQuestionsItemParticularTimeWindow($params)
    {
        $endpoint = $this->_api.'/items/'.$params['id_item'].'contacts/questions/time_window?last='.$params['last'].'&unit='.$params['unit'];
        $response = $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();
        return $response;
    }

    /**
    * 
    * GET received questions  
    *
    *
    * @return array     
    *
    **/
    public function getReceivedQuestions()
    {
        $endpoint = $this->_api.'/received_questions/search';
        $response = $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();
        return $response;
    }

    /**
    * 
    * GET question Info
    *
    * @var array
    *      id_question
    *
    * @return array     
    *
    **/
    public function getQuestionInfo($params)
    {
        $endpoint = $this->_api.'/questions/'.$params['id_question'];
        $response = $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();
        return $response;
    }
    

    /**
    * 
    * GET the property description of the item 
    *
    * @var array
    *      id_item
    *
    * @return array     
    *
    **/
    public function getPropertyDescriptionItem($params)
    {
        $endpoint = $this->_api.'/items/'.$params['id_item'].'/description';
        $response = $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();
        return $response;
    }

    /**
    * 
    * GET Search my own items
    *
    * @var array
    *      id_user
    *
    * @return array     
    *
    **/
    public function getDealByUse($params)
    {
        $endpoint = $this->_api.'/uses/'.$params['id_user'].'/items/search?access_token='.self::$cfg['token'];
        $response = $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();
        return $response;
    }

    /**
    * 
    * GET Returns recent seller orders
    *
    * @var array
    *      id_seller
    *
    * @return array     
    *
    **/
    public function getRecentSeller($params)
    {
        $endpoint = $this->_api.'/orders/'.$params['id_order'].'/&access_token='.self::$cfg['token'];
        $response = $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();
        return $response;
    }

    /**
    * GET Returns brand cars and the children category of marker

    *
    * @var array
    *      id_seller
    *
    * @return array     
    *
    **/
    public function getMarker()
    {
        $endpoint = $this->_api.'/categories/MLB1744';
        $response = $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();
            return [
                'status' => 'ok',
                'body' => $response['body']['children_categories']
            ];
    }

    /**
    * GET Returns model cars and the children category of model

    *
    * @var array
    *      id_seller
    *
    * @return array     
    *
    **/
    public function getModelAndCategory($params)
    {
        $endpoint = $this->_api.'/categories/'.$params['id_marker'];
        $response = $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();
            return [
                'status' => 'ok',
                'body' => $response['body']['children_categories']
            ];
    }

    /**
    * 
    * GET Returns orders info
    *
    * @var array
    *      id_seller
    *
    * @return array     
    *
    **/
    public function getRecentSearchSeller($params)
    {
        $endpoint = $this->_api.'/orders/search/recent?seller='.$params['id_seller'].'&access_token'.self::$cfg['token'];
        $response = $this->request($endpoint)
            ->addHeader('Accept', 'application/json')
            ->getResponse();
        return $response;
    }

    /**
    * 
    * Disable Promotional packages are packages with classified publications of car dealerships
    *
    *
    * @var array
    *
    * @return array     
    *
    **/
    public function postDeal($params)
    {
        $endpoint = $this->_api . '/items?'.self::$cfg['token'];

        $attributes=[
            [
                'id'=>'BRAND',
                'value_id'=>$params['marker']
            ],
            [
                'id'=>'MODEL',
                'value_id'=>$params['model']
            ],
            [
                'id'=>'FUEL_TYPE',
                'value_id'=>$params['fuel_type']
            ],
            [
                'id'=>'KILOMETERS',
                'value_name'=>$params['km'].' km'
            ],
            [
                'id'=>'VEHICLE_YEAR',
                'value_name'=>$params['year']
            ],
            [
                'id'=>'DOORS',
                'value_name'=>$params['doors']
            ],
            [
                'id'=>'COLOR',
                'value'=>$params['color']
            ],
            [
                'id'=>'VEHICLE_TYPE', 
                'value_id'=>'MLB1744',
            ]
        ];

        foreach($params['attributes'] as $key => $value){
            $aux=[
                'id'=>$value,
                'value'=>true
            ];

            array_push($attributes, $aux);
        }

        $pictures = array();
        foreach($params['pictures'] as $key =>$value){
            $aux=['source'=>$value];
            array_push($pictures, $aux);
        }

        $location = [
            'country'=>[
                'id'=>'BR'
            ],
            
            'state'=>[
                'id'=>$params['id_state']
            ],
            
            'city'=>[
                'id'=>$params['id_city']
            ]
        ];

        return $this->request($endpoint)
            ->addHeader('Content-Type', 'application/json')
            ->addPost('title', $params['title'])
            ->addPost('category_id', $params['category'])
            ->addPost('price', $params['price'])
            ->addPost('currency_id', 'BRL')
            ->addPost('buying_mode',$params['buying_mode'])
            ->addPost('available_quantity', $params['available_quantity'])
            ->addPost('listing_type_id', 'free')
            ->addPost('condition', $params['condition'])
            ->addPost('pictures', $pictures)
            ->addPost('location', $location)
            ->addPost('attributes', $attributes)
            ->addPost('description', $params['description'])
            ->getResponse();
    }

    /**
    * 
    * Post a new Answer
    *
    *
    * @var array
    *      id_question
    *      answer
    *
    * @return array     
    *
    **/
    public function postAnswerQuestion($params)
    {
        $endpoint = $this->_api . '/answers?access_token='.self::$cfg['token'];
        return $this->request($endpoint)
            ->addHeader('Content-Type', 'application/json')
            ->addPost('question_id', $params['id_question'])
            ->addPost('text', $params['answer'])
            ->getResponse();
    }

    /**
    * 
    * Post block user to send question
    *
    *
    * @var array
    *      id_seller
    *      id_user
    *
    * @return array     
    *
    **/
    public function postAnswerQuestionBlock($params)
    {
        $endpoint = $this->_api . '/users/'.$params['id_seller'].'questions_blacklist?access_token='.self::$cfg['token'];
        return $this->request($endpoint)
            ->addHeader('Content-Type', 'application/json')
            ->addPost('user_id', $params['id_user'])
            ->getResponse();
    }

    /**
    * 
    * Delete a Answer
    *
    *
    * @var array
    *      id_question
    *      answer
    *
    * @return array     
    *
    **/
    public function deleteAnswerQuestion($params)
    {
        $endpoint = $this->_api . '/'.$params['id_question'].'?access_token='.self::$cfg['token'];
        return $this->request($endpoint)
            ->addHeader('Content-Type', 'application/json')
            ->addDelete(true)
            ->getResponse();
    }

    /**
    * 
    * Delete block user to send question
    *
    *
    * @var array
    *      id_seller
    *      id_blocked_user
    *
    * @return array     
    *
    **/
    public function deleteAnswerQuestionBlock($params)
    {
        $endpoint = $this->_api . '/users/'.$params['id_seller'].'questions_blacklist/'.$params['id_blocked_user'].'?access_token='.self::$cfg['token'];
        return $this->request($endpoint)
            ->addHeader('Content-Type', 'application/json')
            ->addDelete(true)
            ->getResponse();
    }


    /**
    * 
    * update deal
    *
    *
    * @var array
    *      id_seller
    *      id_blocked_user
    *
    * @return array     
    *
    **/
    public function putDeal($params)
    {
        $endpoint = $this->_api . '/items'.$params['id_deal'].'?access_token='.self::$cfg['token'];
        $request = $this->request($endpoint);
        $request->addHeader('Content-Type', 'application/json');

        foreach ($params['atributtes'] as $key => $value) {
            $request->addPut($key,$value);
        }
                
        $request->getResponse();
    }

    /**
    * 
    * update deal
    *
    *
    * @var array
    *      id_seller
    *      id_blocked_user
    *
    * @return array     
    *
    **/
    public function putStatusDeal($params)
    {
        $endpoint = $this->_api . '/items'.$params['id_deal'].'?access_token='.self::$cfg['token'];
        $request = $this->request($endpoint);
        $request->addHeader('Content-Type', 'application/json');
        $request->addPut('status',$params['status']);        
        $request->getResponse();
    }

    /**
     *
     * Used internally, but can also be used by end-users if they want
     * to create completely custom API queries without modifying this library.
     *
     * @param string $url
     *
     * @return array
     */
    public function request($url)
    {
        return new Request($this, $url);
    }
}