import os
import shutil
import time

def rename_files(dragged_files):
    # 从participants.txt读取归属人信息
    participants = []
    with open('participants.txt', 'r', encoding='utf-8') as f:
        for line in f:
            participants.append(line.strip())

    # 提示选择时间
    print("请选择时间：")
    print("1. 当前时间")
    print("2. 文件时间")
    print("3. 自定义时间")
    time_option = int(input())

    if time_option == 1:
        time_str = time.strftime('%y%m%d%H%M')
    elif time_option == 2:
        file_mtime = os.path.getmtime(dragged_files[0])  # 获取第一个文件的修改时间
        time_str = time.strftime('%y%m%d%H%M', time.localtime(file_mtime))
    elif time_option == 3:
        custom_time = input("请输入自定义时间（格式：yymmddhhmm）：")
        time_str = custom_time

    # 提示选择文件归属人
    print("请选择文件归属人：")
    for i, participant in enumerate(participants, start=1):
        print(f"{i}. {participant}")
    owner_index = int(input()) - 1
    file_owner = participants[owner_index]

    for file_path in dragged_files:
        # 获取文件名和文件扩展名
        file_name = os.path.basename(file_path)
        file_ext = os.path.splitext(file_name)[1]

        new_file_name = f"{time_str}__{file_owner}__{file_name}"
        new_file_path = os.path.join(os.getcwd(), new_file_name)

        # 复制文件到当前文件夹
        shutil.copyfile(file_path, new_file_path)
        print(f"已复制文件：{new_file_name}")

while True:
    # 获取文件拖入的路径
    dragged_files = input("请将文件拖入命令行窗口并按回车，或输入 Q 退出：")
    if dragged_files.lower() == 'q':
        break
    dragged_files = dragged_files.split()
    rename_files(dragged_files)
