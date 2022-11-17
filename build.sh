cp ".env-example" ".env"

cp "mariadb/sql/database.sql-example" "mariadb/sql/database.sql"
cp "mariadb/sql/database.sql-example" "mariadb/sql/database.sql"

docker compose build
