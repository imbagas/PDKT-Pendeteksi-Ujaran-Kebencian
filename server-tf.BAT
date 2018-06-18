echo off
cls
echo ===================================================================================
echo				Mengaktifkan Server Klasifikasi (Tensorflow)
echo ===================================================================================
e:\
cd E:\xampp\htdocs\pdkt\CNN-balaibahasapure
echo .................................Server Aktif
start python ./eval.py --checkpoint_dir="./runs/1528426057/checkpoints/"
pause