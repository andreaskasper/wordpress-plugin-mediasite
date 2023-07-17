sudo docker build -t builder -f build.Dockerfile .

sudo docker run -it --rm -v ${PWD}:/app/:rw --entrypoint codecept builder $@