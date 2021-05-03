# Project title

### NotFLIX

** Version 1.0.0 **

##  About / Synopsis

Project status: working/prototype.

NotFlix - cloud based video streaming service. NotFLIX is created to be an open source solution for streaming live video, right into the web browser using the HTML5 video tag.

The current version is a working prototype, which showcases the main ideas. The main design goal is low resource usage, build a proof-of-concept cloud application and NotFlix would gain insights into how their users are interacting with content e.g pause, play, stop etc. Additionally, the analytics team can extract data into their analytic platform using a secure connection. 

The proof-of-concept demonstrates the functionality of the tiers and inlcudes a minimum load balancing to handle web traffic, showcases high availability, and automated shaping of the service component.

##  Getting started

Instructios will guide to setup working environment for development and testing purposes. Deployment notes guides you to deploy the project on a live system.

>   * [Installation](#installation)

>   * [Deployment](#deployment)

>   * [Contribution](#contribution)

>   * [License](#license)

##  Installation

1.  Initially you should have administrator privileges, to setup the environment

2.  Install a web server on your development environment, and then install PHP and MySQL using docker file
    Set up develop evironment using docker-compose.yaml file

    ```
    docker build .
    docker-compose up -d
    docker images
    docker ps
    ```

3.  Configure your server to deploy PHP files. Create your .php files, place them in your web directory, and 
    the server will automatically parse them for you.
    e.g index.php

4.  Setup your database configurations and connect to the database for storing information.
    use <database/schema>;

##  Deployment

1.  Clone the github repository

    e.g github public repo link:

    ```
    git clone https://github.com/DawnDuskSolutions/notflix.git 
    ```

    use relavent commands, to commit and push to the repo
    ```
    git status
    
    git add *
    
    git commit -m "initial commit"
    
    git push -u origin master
    ```
2.  Go to your - Github repository - establish webhook settings - trigger jenkins maven build on every git push

3.  Using - Jenkins plugin manage credentials - establish docker hub credentials

4.  Deploy jenkins pipeline job - using Jenkins file in the github repository

5.  Jenkins build will push the image to docker hub 

    docker hub repository link: [DockerHub](https://hub.docker.com)


6.  Runtime setup kubernetes server environment, 
    we can deploy the docker hub image by using yaml configuration files in the github repository.

    e.g myappdeploy.yaml, myappservice.yaml

    ```
    kubectl get nodes
    
    kubectl apply -f myappdeploy.yaml
    
    kubectl apply -f myappservice.yaml

    kubectl get all

    curl http://localhost:8088/notflix
    ```



![Video streaming page](https://github.com/DawnDuskSolutions/notflix/blob/master/images/streampg.png?raw=true)



5.  After kubernetes orchestration - hit the browser

    you can view the home page on the browser

##  Contribution

[Dawn Dusk Solutions](https://www.dawndusksolutions.com/ "Dawn Dusk Solutions")

##  License

    NotFLIX Ltd - UK based video streaming service with a global client base.

---