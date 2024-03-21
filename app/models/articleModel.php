<?php 

namespace app\models;

class ArticleModel extends mainModel {

    private int $idArticle;
    private string $title;
    private $date;
    private string $content;
    private $image;

    public function __construct(string $title, $date, string $content, $image) {
        $this->title = $title;
        $this->date = $date;
        $this->content = $content;
        $this->image = $image;
    }
    
    public function createArticle(array $params) {
        $sql = "INSERT INTO `article` VALUES (?, ?, ?, ?)";
        // prepare values to execute the query
        $values = [
            $params['title'],
            $params['date'],
            $params['content'],
            $params['image']
        ];

        $result = $this->request($sql, $values);
        return $result;
    }

    public function findArticleBy(array $params) {
        $fields = [];
        $values = [];
        
        foreach($criteria as $field => $value){
            $fields[] = "$field = ?";
            $values[] = $value;
        }
        // transforms fields array into a string
        $fieldsList = implode(' AND ', $fields);

        $result = $this->request('SELECT * FROM `article` WHERE '.$fieldsList, $values)->fetchAll();
        return $result;
    }

    public function updateArticle(int $idArticle, array $params) {
        $fields = [];
        $values = [];

        foreach($params as $field => $value) {
            $fields[] = "$field = ?";
            $values[] = $value;
        }

        $fieldsList = implode(', ', $fields);
        $result = $this->request('UPDATE `article` SET '.$fieldsList. 'WHERE id='.$idArticle, $valeurs);

        return $result;
    }

    public function deleteArticle(int $idArticle) {
        $result = $this->request('DELETE FROM `article` WHERE id='.$idArticle);

        return $result;
    }
}