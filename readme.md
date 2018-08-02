# PDKT-Pendeteksi Ujaran Kebencian
Adalah aplikasi pendeteksi kalimat ujaran kebencian pada gambar yang ada di twitter berbasis web.

berdasarkan refrensi:
It is slightly simplified implementation of Kim's [Convolutional Neural Networks for Sentence Classification](http://arxiv.org/abs/1408.5882) paper in Tensorflow.


## Requirements *yang harus di install

- Python 3
- Tensorflow > 0.12
- Numpy
- Nodejs
- Python CGI Bin
- Xampp

## Install tensorflow
*untuk klasifikasi
Please see the [install guide](https://www.tensorflow.org/install/) in tensorflow website.


## Training


Train:

```bash
./train.py
```

Train, including the Kaggle dataset:

```bash
./train.py --data_file ./data/train-all.txt
```

## Evaluating

```bash
./eval.py --checkpoint_dir="./runs/1459637919/checkpoints/"
```

Replace the checkpoint dir with the output from the training. To use your own data, change the `eval.py` script to load your data.


## References

- [Convolutional Neural Networks for Sentence Classification](http://arxiv.org/abs/1408.5882)
- [A Sensitivity Analysis of (and Practitioners' Guide to) Convolutional Neural Networks for Sentence Classification](http://arxiv.org/abs/1510.03820)
