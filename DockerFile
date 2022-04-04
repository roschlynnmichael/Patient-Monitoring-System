FROM ubuntu
MAINTAINER roschlynn@outlook.com

RUN apt-get update
RUN apt-get upgrade
CMD["echo","Image Created Successfully"]
