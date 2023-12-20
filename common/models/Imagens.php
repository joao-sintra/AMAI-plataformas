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
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['produto_id'], 'required'],
            [['produto_id'], 'integer'],
            [['produto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Produtos::class, 'targetAttribute' => ['produto_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function upload()
    {

        if ($this->validate()) {

            $uploadPath = Yii::getAlias('@frontend/web/public/imagens/produtos/') . $this->imageFile->baseName . uniqid() . '.' . $this->imageFile->extension;

            $this->imageFile->saveAs($uploadPath, false);

            return true;
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
