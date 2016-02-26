<?php
//tartarus/src/app.php
use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller;

interface ControllerResolverInterface
{
    function getController(Request $request);
    function getArguments(Request $request, $controller);
} 

class leapYearController
{
    public function indexAction($request)
    {
        if(is_leap_year($request->attributes->get('year'))){
            return new Response('Yep, this is a leap year!');
        }
        
        return new Response('Nope, this is not a leap year.');
    }
}

function is_leap_year($year = null)
{
    if(null === $year){
        $year = date('Y');
    }
    
    return 0 === $year % 400 || (0 === $year % 4 && 0 != $year % 100);
}


$routes = new Routing\RouteCollection();
$routes->add('leap_year', new Routing\Route('/is_leap_year/{year}',array(
    'year' => null,
    '_controller' => 'LeapYearController::indexAction',
)));

return $routes;