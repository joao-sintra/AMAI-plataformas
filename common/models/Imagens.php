<?php

namespace common\models;

use common\models\Produtos;
use Yii;

/**
 * This is the model class for table "imagem".
 *
 * @property int $id
 * @property string $fileName
 * @property int $produto_id
 *
 * @property Produtos $produto
 */
class Imagens extends \yii\db\ActiveRecord
{
    public $imageFiles;
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'imagens';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'safe'],
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 10],
            [['produto_id'], 'required', 'message' => 'Tem de selecionar um produto para associar à imagem'],
            [['produto_id'], 'integer'],
            [['produto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Produtos::class, 'targetAttribute' => ['produto_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function upload()
    {

        $uploadPaths = [];

        if ($this->validate()) {

            foreach ($this->imageFiles as $file) {
                $uid = uniqid();
                $uploadPathBack = Yii::getAlias('@backend/web/imagens/') . $uid . $file->baseName . '.' . $file->extension;
                $uploadPathFront = Yii::getAlias('@frontend/web/imagens/') . $uid . $file->baseName . '.' . $file->extension;

                $file->saveAs($uploadPathBack, false);
                $file->saveAs($uploadPathFront, false);
                $uploadPaths[] = $uploadPathBack;

            }
            return $uploadPaths;
        } else {
            return false;
        }
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fileName' => 'Imagens',
            'produto_id' => 'Produtos Associado',
        ];
    }

    /**
     * Gets query for [[Produtos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduto()
    {
        return $this->hasOne(Produtos::class, ['id' => 'produto_id']);
    }
}
