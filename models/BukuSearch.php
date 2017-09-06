<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Buku;

/**
 * BukuSearch represents the model behind the search form about `app\models\Buku`.
 */
class BukuSearch extends Buku
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_pengarang', 'id_kategori'], 'integer'],
            [['nama', 'tanggal_terbit'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Buku::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_pengarang' => $this->id_pengarang,
            'tanggal_terbit' => $this->tanggal_terbit,
            'id_kategori' => $this->id_kategori,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama]);

        return $dataProvider;
    }
}
