<?php

namespace App\Controller;

use App\Entity\User;
use App\Services\UserProvider;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MysqlInjectionController.
 *
 * @author Manuel Voss <manuel.voss@i22.de>
 */
class MysqlInjectionController extends Controller
{
    /**
     * @Route("injection/basic")
     */
    public function basicInjection()
    {
        mysqli_connect('localhost', 'root', 'root');
        mysqli_select_db('test', 'testdn');

        $user = $_POST['user'];
        $pass = $_POST['password'];
        $re = mysqli_query('test', "select * from zend_adminlist where user_name = '$user' and password = '$pass'");

        if (mysqli_num_rows($re) == 0) {
            echo '0';
        } else {
            echo '1';
        }
    }

    /**
     * @Route("injection/basic-orm")
     * @param EntityManager $entityManager
     */
    public function basicOrmInjection(EntityManager $entityManager)
    {
        $query = $entityManager->createQuery('SELECT * FROM \App\Entity\User u WHERE u.username = ' . $_GET['user']);
        $users = $query->getResult();
    }

    /**
     * @Route("injection/intermediate-orm")
     * @param Request $request
     */
    public function intermediateOrmInjection(Request $request)
    {
        $users = $this->getDoctrine()->getRepository(User::class)->createQueryBuilder('u')
            ->where('u.username = ' . $request->get('user'))
            ->getQuery()
            ->getResult();

        print_r($users);
    }

    /**
     * @Route("injection/advanced-orm")
     * @param Request $request
     * @param UserProvider $userProvider
     */
    public function advancedOrmInjection(Request $request, UserProvider $userProvider)
    {
        $users = $userProvider->provideUsers($request->get('user'));
        return $this->json($users);
    }
}
