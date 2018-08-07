<?php
namespace app\models;
use Yii;
use yii\db\ActiveRecord;

class Noticia extends \yii\db\ActiveRecord{
    public static function getDb() {
        return Yii::$app->db;
    }
    public static function tableName() {
        return 'noticia';
    }
}