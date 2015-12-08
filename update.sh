if [ -z "$1" ]
  then
    echo "give your password. eg: './update password#!84' "
    exit 1
fi

liquibase --username=root --password=$1 --url=jdbc:mysql://localhost/blog --changeLogFile=db.xml --classpath=mysql-connector-java-5.1.34-bin.jar update
