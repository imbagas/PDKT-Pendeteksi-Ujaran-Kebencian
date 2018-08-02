# cnn-text-classification-tf

The base project is **[dennybritz/cnn-text-classification-tf](https://github.com/dennybritz/cnn-text-classification-tf)**.  It can classify the positive and negative movie reviews. I modified it to have 5 labels(0,1,2,3,4).


It is slightly simplified implementation of Kim's [Convolutional Neural Networks for Sentence Classification](http://arxiv.org/abs/1408.5882) paper in Tensorflow.


## Requirements

- Python 3
- Tensorflow > 0.12
- Numpy

## Install tensorflow

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
