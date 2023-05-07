FROM wordpress:latest

# Node.jsとnpmをインストールする
RUN apt-get update && \
    apt-get install -y \
    vsftpd \
    openssh-server \
    nodejs \
    npm

# FTPユーザーを作成する
ARG FTP_USER_NAME
ARG FTP_USER_PASS
RUN useradd -m ${FTP_USER_NAME} && \
    echo "${FTP_USER_NAME}:${FTP_USER_PASS}" | chpasswd && \
    usermod -aG www-data ${FTP_USER_NAME}

# SSHユーザーを作成する
ARG SSH_USER_NAME
ARG SSH_USER_PASS
RUN useradd -m ${SSH_USER_NAME} && \
    echo "${SSH_USER_NAME}:${SSH_USER_PASS}" | chpasswd && \
    usermod -aG www-data ${SSH_USER_NAME}

# FTP/SSHの設定をする
COPY vsftpd.conf /etc/vsftpd.conf
RUN echo "root:${SSH_USER_PASS}" | chpasswd
RUN sed -i 's/#PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config
RUN mkdir /run/sshd

# WordPressのディレクトリに権限を与える
RUN chown -R ftpuser:ftpuser /var/www/html/wp-content/themes/ && \
    chmod -R 755 /var/www/html/wp-content/themes/ && \
    chmod -R g+w /var/www/html/wp-content/themes/

COPY . /var/www/html/wp-content/themes/pumpkin_cafe

# FTP/SSHのポートを開く
EXPOSE 21 22
