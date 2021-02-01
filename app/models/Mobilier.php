<?php

/**
 * Class Mobilier
 * Gère la logique métier pour les articles
 */
class Mobilier {
    /**
     * @var Database $db
     */
    private $db;

    /**
     * Post constructor.
     */
    public function __construct() {
        $this->db = new Database();
    }

    /**
     * @param $data
     * @return mixed
     * Récupère tous les articles en bdd
     */
    public function findAllPosts($data) {
        if(!empty($data))
        {
            $this->db->query('SELECT * FROM mobiliers WHERE type = "'. $data .'" ORDER BY added_at ASC');
            return $this->db->fetchAll();
        } else $this->db->query('SELECT * FROM mobiliers ORDER BY added_at ASC');

        return $this->db->fetchAll();
    }

    /**
     * @return mixed
     */
    public function findFilters()
    {
        $this->db->query('SELECT DISTINCT type FROM `mobiliers`');

        return $this->db->fetchAll();
    }

    /**
     * @param $data
     * @return bool
     */
    public function addPost($data)
    {
        $this->db->query('INSERT INTO mobiliers (mobilier_id, modele, couleur, taille, type, price, added_at, user_id) VALUES (:mobilier_id, :modele, :couleur, :taille, :type, :price , :added_at, :user_id)');
        $this->db->bind(':mobilier_id', $data['mobilier_id']);
        $this->db->bind(':modele', $data['modele']);
        $this->db->bind(':couleur', $data['couleur']);
        $this->db->bind(':taille', $data['taille']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':added_at', $data['added_at']);
        $this->db->bind(':user_id', $data['user_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findPostById($id)
    {
        $this->db->query('SELECT * FROM mobiliers WHERE mobilier_id = :mobilier_id');
        $this->db->bind(':mobilier_id', $id);
        return $this->db->fetch();
    }

    /**
     * @param $data
     * @return bool
     */
    public function updatePost($data)
    {
        $this->db->query('UPDATE mobiliers SET modele = :modele, couleur = :couleur, taille = :taille, type = :type , price = :price WHERE mobilier_id = :mobilier_id');
        $this->db->bind(':mobilier_id', $data['mobilier_id']);
        $this->db->bind(':modele', $data['modele']);
        $this->db->bind(':couleur', $data['couleur']);
        $this->db->bind(':taille', $data['taille']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':price', $data['price']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public function deletePost($id)
    {
        $this->db->query('DELETE FROM mobiliers WHERE mobilier_id = :id');

        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function showComments($id) {
        $this->db->query('SELECT * FROM comments WHERE mobilier_id = ' . $id . ' ORDER BY created_at ASC');

        return $this->db->fetchAll();
    }

    /**
     * @param $data
     * @return bool
     */
    public function commentOnPage($data)
    {
        $this->db->query('INSERT INTO comments (comment_id, user_id, pseudo, text, created_at, mobilier_id) VALUES (:comment_id, :user_id, :pseudo, :text, :created_at, :mobilier_id)');

        $this->db->bind(':comment_id', $data['comment_id']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':pseudo', $data['pseudoComment']);
        $this->db->bind(':text', $data['textComment']);
        $this->db->bind(':created_at', $data['created_at']);
        $this->db->bind(':mobilier_id', $data['mobilier_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
