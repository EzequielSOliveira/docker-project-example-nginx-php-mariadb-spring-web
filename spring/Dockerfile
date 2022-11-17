FROM maven:3.8.6-openjdk-18 AS maven
COPY pom.xml .
RUN mvn dependency:go-offline
COPY src src
RUN mvn dependency:resolve-plugins dependency:resolve package
FROM openjdk:latest
EXPOSE 8080
CMD java -jar /data/demo-0.0.1-SNAPSHOT.jar
COPY --from=maven /target/demo-0.0.1-SNAPSHOT.jar /data/demo-0.0.1-SNAPSHOT.jar
