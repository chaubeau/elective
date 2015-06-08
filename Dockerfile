# VERSION       1.5

# use the 
FROM index.alauda.cn/chaubeau/91606cc1fef1:1.5

MAINTAINER chaubeau@163.com

# start servicae
RUN echo docker|passwd --stdin root


# expose memcached port
EXPOSE 80
EXPOSE 22


CMD   sh /run.sh
