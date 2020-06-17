<?php
    
namespace App\Controller;
    
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
    
class DefaultController extends AbstractController
{
    /**
     * @Route("/{reactRouting}", name="home", defaults={"reactRouting": null})
     */
    public function index()
    {
        return $this->render('default/index.html.twig');
    }

     /**
     * @Route("/api/characters", name="characters")
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getCharacters()
    {
        $characters = [
            [
                'id' => 1,
                'name' => 'Luna Lovegood',
                'house' => 'Serdaigle',
                'patronus' => 'Lièvre',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'imageURL' => 'https://pm1.narvii.com/6913/0258a4e54d659060d8075d7b3e993cecfd888505r1-1200-1601v2_uhq.jpg'
            ],
            [
                'id' => 2,
                'name' => 'Ginny Weasley',
                'house' => 'Gryffondor',
                'patronus' => 'Cheval',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'imageURL' => 'https://vignette.wikia.nocookie.net/harrypotter/images/3/39/PromoHP7_Ginny_Weasley.jpg/revision/latest/scale-to-width-down/350?cb=20110901204301&path-prefix=fr'
            ],
            [
                'id' => 3,
                'name' => 'Drago Malefoy',
                'house' => 'Serpentard',
                'patronus' => 'Aucun',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'imageURL' => 'https://i.skyrock.net/5220/80925220/pics/3229722319_1_2_A1SDv2vN.jpg'
            ],
            [
                'id' => 4,
                'name' => 'Ron Weasley',
                'house' => 'Gryffondor',
                'patronus' => 'Jack Russel Terrier',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'imageURL' => 'https://vignette.wikia.nocookie.net/hermione-granger/images/8/85/Ron_Weasley.jpg/revision/latest/scale-to-width-down/400?cb=20130321175538&path-prefix=fr'
            ],
        ];
    
        $response = new Response();

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:8080');

        $response->setContent(json_encode($characters));
        
        return $response;
    }

      /**
     * @Route("/api/users", name="users")
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */

    public function getUsers()
    {
        $users = [
            [
                'id' => 1,
                'email' => 'barack@obama.com',
                'password' => 'usa',
                'pseudo' => 'Petit Chaton',
                'avatar' => 'https://upload.wikimedia.org/wikipedia/commons/0/01/Poster-sized_portrait_of_Barack_Obama_OrigRes.jpg'
            ],
            [
                'id' => 2,
                'email' => 'dalai@lama.com',
                'password' => 'peace',
                'pseudo' => 'Aigle Royal',
                'avatar' => 'https://upload.wikimedia.org/wikipedia/commons/1/1c/Dalai_Lama_w_Sejmie_w_2009.jpg'
            ],
        ];
    
        $response = new Response();

        $response->headers->set('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');
        $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:8080');

        $response->setContent(json_encode($users));
        
       
        return $response;
    }

     /**
     * @Route("/api/logged", name="logged")
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */

    public function checkConnect()
    {
        if ($_POST['email'] == $users[email]) {
            $logged = true;

            $response = new Response();
            $response->setContent(json_encode($logged));
        }
        ;
    
        $response = new Response();

        $response->headers->set('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');
        $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:8080');

        $response->setContent(json_encode($users));
        
       
        return $response;
    }
}

