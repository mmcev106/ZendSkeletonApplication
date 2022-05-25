<?php
/**
 * Date: 1/23/2020
 * Time: 9:37 PM
 */

namespace App;

use App\Auth\Identity;
use App\Di\Injector;
use App\Di\InjectorFactory;
use App\Di\ServiceManager;
use App\Model\Service\UserService;
use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use App\Request\RequestInterface as Request;

/**
 * @property Identity|null identity
 */
class AbstractAppController extends AbstractActionController implements Di\InjectableInterface
{

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var AuthenticationService
     */
    protected $authService;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var MvcEvent
     */
    protected $event;

    /**
     * @var UserService
     * @Inject(name="App\Model\Service\UserService")
     */
    protected $userService;

    protected $redirection;
    /**
     * @param UserService $userService
     * @return AbstractAppController
     */
    public function setUserService($userService)
    {
        $this->userService = $userService;
        return $this;
    }


    /**
     * Register the default events for this controller
     *
     * @return void
     */
    protected function attachDefaultListeners()
    {
        parent::attachDefaultListeners();
        $events = $this->getEventManager();
        $events->attach(MvcEvent::EVENT_DISPATCH, [$this, 'initialize'], 999);
        $events->attach(MvcEvent::EVENT_DISPATCH, [$this, 'authenticate'], 995);
    }

    public function initialize()
    {
        $serviceManager = $this->event->getApplication()->getServiceManager();
        $this->container = new ServiceManager();
        $this->container->setContainer($serviceManager);
    }

    public function authenticate()
    {
        $this->authService = $this->userService->getAuthenticationService();
        if ($this->authService->hasIdentity()) {
            $currentUrl = $_SERVER['REQUEST_URI'];
            $this->redirection = $this->getRedirection();
            return $this->redirect()->toUrl('/public/index.php/login'.'?redirect='.$currentUrl);
//            throw new \Exception("Invalid Session. Please login again.");
        }
        $this->identity = $this->authService->getIdentity();
     }

    protected function getIdentity()
    {
        if (!$this->identity) {
            return $this->plugin('identity');
        }
        return $this->identity;
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param ContainerInterface $container
     * @return AbstractAppController
     */
    public function setContainer($container = null)
    {
        $this->container = $container;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getRedirection()
    {
        return $this->redirection;
    }

    public function setRedirection()
    {
        $this->redirection = $_SERVER['REQUEST URI'];
        return $this;
    }


}