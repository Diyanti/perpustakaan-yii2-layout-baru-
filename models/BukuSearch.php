<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Buku;

/**
 * BukuSearch represents the model behind the search form of `app\models\Buku`.
 */
class BukuSearch extends Buku
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_penulis', 'id_penerbit', 'id_kategori'], 'integer'],
            [['nama', 'tahun_terbit', 'sinopsis', 'sampul', 'berkas'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
            'tahun_terbit' => $this->tahun_terbit,
            'id_penulis' => $this->id_penulis,
            'id_penerbit' => $this->id_penerbit,
            'id_kategori' => $this->id_kategori,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'sinopsis', $this->sinopsis])
            ->andFilterWhere(['like', 'sampul', $this->sampul])
            ->andFilterWhere(['like', 'berkas', $this->berkas]);

        return $dataProvider;
    }
}
