<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
/**
 * Class Posts
 * Gère les articles du blog.
 */
class Mobiliers extends Controller {
    /**
     * @var mixed
     */
    private $postModel;

    /**
     * Posts constructor
     * Charge le model des articles
     */
    public function __construct() {
        $this->postModel = $this->loadModel('Mobilier');
    }

    /**
     * Récupère tous les articles et les retourne à la vue.
     */
    public function index() {
        $posts = $this->postModel->findAllPosts('');
        $filters = $this->postModel->findFilters();

        $data = [
            'mobiliers' => $posts,
            'filters' => $filters
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'mobiliers' => $posts,
                'filters' => $filters,
                'filter' => $_POST['filters']
            ];

            if ($this->postModel->findAllPosts($_POST['filters'])) {
                $filter = $this->postModel->findAllPosts($_POST['filters']);

                $data = [
                    'mobiliers' => $filter,
                    'filters' => $filters,
                    'filter' => $_POST['filters']
                ];

                $this->render('mobiliers/index', $data);
            } else {
                die("Something went wrong, please try again!");
            }

            $this->render('mobiliers/index', $data);
        }

        $this->render('mobiliers/index', $data);
    }

    /**
     * @param $id
     */
    public function page($id)
    {
        $post = $this->postModel->findPostById($id);
        $comments = $this->postModel->showComments($id);

        $data = [
            'comments' => $comments,
            'mobilier' => $post,
            'modele' => '',
            'couleur' => '',
            'taille' => '',
            'type' => '',
            'price' => '',
            'pseudoComment' => '',
            'textComment' => '',
            'modeleError' => '',
            'couleurError' => '',
            'tailleError' => '',
            'typeError' => '',
            'priceError' => '',
            'pseudoCommentError' => '',
            'textCommentError' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'user_id' => $_SESSION['user_id'],
                'mobilier_id' => $id,
                'comments' => $comments,
                'mobilier' => $post,
                'pseudoComment' => trim($_POST['pseudoComment']),
                'textComment' => trim($_POST['textComment']),
                'pseudoCommentError' => '',
                'textCommentError' => '',
            ];

            if(empty($data['pseudoComment'])) {
                $data['pseudoCommentError'] = 'The pseudo of a comment cannot be empty';
            }
            if(empty($data['textComment'])) {
                $data['textCommentError'] = 'The text of a comment cannot be empty';
            }

            if (empty($data['pseudoCommentError']) && empty($data['textCommentError'])) {
                if ($this->postModel->commentOnPage($data)) {
                    header("Location: " . URL_ROOT . "/mobiliers/page/" . $id);
                } else {
                    die("Something went wrong, please try again!");
                }
            } else {
                $this->render("/mobiliers/page/", $data);
            }
        }

        $this->render('mobiliers/page', $data);
    }

    public function create()
    {
        if (!isLoggedIn()) {
            header("Location: " . URL_ROOT . '/mobiliers');
        }

        $data = [
            'modele' => '',
            'couleur' => '',
            'taille' => '',
            'type' => '',
            'price' => '',
            'modeleError' => '',
            'couleurError' => '',
            'tailleError' => '',
            'typeError' => '',
            'priceError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'modele' => trim($_POST['modele']),
                'couleur' => trim($_POST['couleur']),
                'taille' => trim($_POST['taille']),
                'type' => trim($_POST['type']),
                'price' => trim($_POST['price']),
                'user_id' => $_SESSION['user_id'],
                'modeleError' => '',
                'couleurError' => '',
                'tailleError' => '',
                'typeError' => '',
                'priceError' => ''
            ];

            if (empty($data['modele'])) {
                $data['modeleError'] = "le modèle de  l'article est requis";
            }

            if (empty($data['couleur'])) {
                $data['couleurError'] = "la couleur de  l'article est requise";
            }

            if (empty($data['taille'])) {
                $data['tailleError'] = "la taille de  l'article est requise";
            }

            if (empty($data['type'])) {
                $data['typeError'] = "le type de  l'article est requis";
            }

            if (empty($data['price'])) {
                $data['priceError'] = "le prix de  l'article est requis";
            }

            if (empty($data['modeleError']) && empty($data['couleurError']) && empty($data['tailleError']) && empty($data['typeError'])) {
                if ($this->postModel->addPost($data)) {
                    header("Location: " . URL_ROOT . '/mobiliers');
                } else {
                    die("Quelque chose c'est mal passé ! Réessayer");
                }
            } else {
                $this->render('mobiliers/create', $data);
            }
        }
        $this->render('mobiliers/create', $data);
    }

    /**
     * @param $id
     */
    public function update($id) {
        $post = $this->postModel->findPostById($id);

        if(!isLoggedIn()) {
            header("Location: " . URL_ROOT . "/mobiliers");
        } elseif($post->user_id != $_SESSION['user_id']){
            header("Location: " . URL_ROOT . "/mobiliers");
        }

        $data = [
            'mobilier' => $post,
            'modele' => '',
            'couleur' => '',
            'taille' => '',
            'type' => '',
            'price' => '',
            'modeleError' => '',
            'couleurError' => '',
            'tailleError' => '',
            'typeError' => '',
            'priceError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'mobilier_id' => $id,
                'mobiliers' => $post,
                'modele' => trim($_POST['modele']),
                'couleur' => trim($_POST['couleur']),
                'taille' => trim($_POST['taille']),
                'type' => trim($_POST['type']),
                'price' => trim($_POST['price']),
                'user_id' => $_SESSION['user_id'],
                'modeleError' => '',
                'couleurError' => '',
                'tailleError' => '',
                'typeError' => '',
                'priceError' => ''
            ];

            if(empty($data['modele'])) {
                $data['modeleError'] = 'The title of a post cannot be empty';
            }
            if(empty($data['couleur'])) {
                $data['couleurError'] = 'The slug of a post cannot be empty';
            }
            if(empty($data['taille'])) {
                $data['tailleError'] = 'The title of a post cannot be empty';
            }
            if(empty($data['type'])) {
                $data['typeError'] = 'The body of a post cannot be empty';
            }
            if(empty($data['price'])) {
                $data['priceError'] = 'The body of a post cannot be empty';
            }

            if($data['modele'] == $this->postModel->findPostById($id)->modele) {
                $data['modeleError'] == 'At least change the modele!';
            }
            if($data['couleur'] == $this->postModel->findPostById($id)->couleur) {
                $data['couleurError'] == 'At least change the couleur!';
            }
            if($data['taille'] == $this->postModel->findPostById($id)->taille) {
                $data['tailleError'] == 'At least change the taille!';
            }
            if($data['type'] == $this->postModel->findPostById($id)->type) {
                $data['typeError'] == 'At least change the type!';
            }

            if (empty($data['modeleError']) && empty($data['couleurError']) && empty($data['tailleError']) && empty($data['typeError'])) {
                if ($this->postModel->updatePost($data)) {
                    header("Location: " . URL_ROOT . "/mobiliers");
                } else {
                    die("Something went wrong, please try again!");
                }
            } else {
                $this->render('mobiliers/update', $data);
            }
        }

        $this->render('mobiliers/update', $data);
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $post = $this->postModel->findPostById($id);

        if (!isLoggedIn())
        {
            header("Location: " . URL_ROOT . "/mobiliers");
        } elseif($post->user_id != $_SESSION['user_id'])
        {
            header("Location: " . URL_ROOT . "/mobiliers");
        }

        $data = [
            'mobilier' => $post,
            'modele' => '',
            'type' => '',
            'modeleError' => '',
            'typeErrors' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if ($this->postModel->deletePost($id))
            {
                header("Location: " . URL_ROOT . "/mobiliers");
            } else {
                die('Something went wrong!');
            }
        }
    }

    /* !Not working because you can't have more then 1 render directed to the same file
    public function comment($id)
    {

        $data = [
            'mobilier_id' => $id,
            'pseudoComment' => '',
            'comment' => '',
            'pseudoCommentError' => '',
            'commentError' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'mobilier_id' => $id,
                'pseudoComment' => trim($_POST['pseudoComment']),
                'textComment' => trim($_POST['textComment']),
                'pseudoCommentError' => '',
                'commentError' => '',
            ];

            if(empty($data['pseudoComment'])) {
                $data['pseudoCommentError'] = 'The pseudo of a comment cannot be empty';
            }
            if(empty($data['comment'])) {
                $data['commentError'] = 'The text of a comment cannot be empty';
            }

            if (empty($data['pseudoCommentError']) && empty($data['commentError'])) {
                if ($this->postModel->commmentOnPage($id)) {
                    header("Location: " . URL_ROOT . "/mobiliers/page/");
                } else {
                    die("Something went wrong, please try again!");
                }
            } else {
                $this->render("/mobiliers/page/", $data);
            }
        }
        $this->render("/mobiliers/page/", $data);
    }*/
}

