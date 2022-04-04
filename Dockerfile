FROM ubuntu
MAINTAINER roschlynn@outlook.com

RUN apt-get update
RUN apt-get upgrade -y
RUN echo "Image Made Successfully"
