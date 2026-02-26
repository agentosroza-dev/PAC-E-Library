## <span class="text-primary">How to Run Mongodb in Docker

### <span class="text-secondary"> 1.Start MongoDB Container
```terminal
docker run --name mongodb -d \
  -p 27017:27017 \
  -v mongodb_data:/data/db \
  -e MONGO_INITDB_ROOT_USERNAME=root \
  -e MONGO_INITDB_ROOT_PASSWORD=1122 \
  mongodb/mongodb-community-server:latest
```

#### <span style="color: var(--color-success)">Basic Commands
Command	Description
docker ps `Show all Docker Container`
docker start mongodb	`Start container`
docker stop mongodb	`Stop containe`
docker restart mongodb	`Restart container`
docker rm mongodb	`Remove container`
docker logs mongodb	`View container logs`
docker stats mongodb	`Monitor resource usage`

### <span class="text-secondary">Set container ID
```terminal
CONTAINER_ID=$(docker ps -qf "name=mongodb")
```

### <span class="text-secondary">2.Copy File to Docker Container

```terminal
# Copy current directory JSON files to container
docker cp . ${CONTAINER_ID}:/jsonbackup
```

### <span class="text-secondary"> Import Methods
#### <span style="color: var(--color-success);font-weigth"> Method 1: Inside Container Shell

#### `Access container shell`
```terminal
docker exec -it ${CONTAINER_ID} bash
```
##### `Import all JSON files`
```terminal
cd /jsonbackup
for file in *.json; do
  collection_name="${file%.json}"
  echo "Importing ${file} into collection: ${collection_name}"
  
  mongoimport \
    --db course \
    --collection ${collection_name} \
    --file ${file} \
    --jsonArray \
    --username root \
    --password 1122 \
    --authenticationDatabase admin
done
```
#### <span style="color: var(--color-success);font-weigth"> Method 2: Direct Command 
```termianl
docker exec ${CONTAINER_ID} bash -c '
  cd /jsonbackup
  for file in *.json; do
    collection_name="${file%.json}"
    echo "Importing ${file}"
    
    mongoimport \
      --db course \
      --collection ${collection_name} \
      --file ${file} \
      --jsonArray \
      --username root \
      --password 1122 \
      --authenticationDatabase admin
  done'
  ```
##### <span style="color: var(--color-success);font-weigth"> Method 3: Import Single File 
```terminal
docker exec ${CONTAINER_ID} mongoimport \
  --db course \
  --collection students \
  --file /jsonbackup/students.json \
  --jsonArray \
  --username root \
  --password 1122 \
  --authenticationDatabase admin
```

### <span class="text-secondary"> MongoDB Shell Access
`Direct MongoDB Shell Access`
```terminal
docker exec -it ${CONTAINER_ID} mongosh \
  -u "root" \
  -p "1122" \
  --authenticationDatabase "admin"
```

### <span class="text-secondary"> 1. Enter container</sapn>
```terminal
docker exec -it ${CONTAINER_ID} bash
```
### <span class="text-secondary">2. Connect to MongoDB
```terminal
mongosh -u "root" -p "1122" --authenticationDatabase "admin"
```
### <span class="text-secondary">3. Use database
```bash
use course
```
### <span class="text-secondary">4. Run queries
```bash
db.students.find().limit(5)
```
### <span class="text-primary">Common Shell Commands
#### `Show databases`
```bash
show dbs
```
#### `Use specific database`
```bash
use course
```
#### `Show collections`
```bash
show collections
```
#### `Count documents`
```bash
db.students.countDocuments()
```
#### `Find documents`
```bash
db.students.find({ grade: "A" }).pretty()
```
#### `Insert document`
```bash
db.students.insertOne({
  name: "John Doe",
  age: 20,
  grade: "A"
})
```
#### `Update document`
```bash
db.students.updateOne(
  { name: "John Doe" },
  { $set: { grade: "A+" } }
)
```

#### `Delete document`
```bash
db.students.deleteOne({ name: "John Doe" })
```
### <span class="text-secondary">Backup Operations
#### <span style="color: var(--color-success);font-weigth">1. Binary Backup (mongodump)
#### `Backup Entire Database`
```terminal
docker exec ${CONTAINER_ID} mongodump \
  --db course \
  --username root \
  --password 1122 \
  --authenticationDatabase admin \
  --out /tmp/backup_$(date +%Y%m%d)
```
#### `Backup Specific Collection`
```terminal
docker exec ${CONTAINER_ID} mongodump \
  --db course \
  --collection students \
  --username root \
  --password 1122 \
  --authenticationDatabase admin \
  --out /tmp/students_backup
```
#### `Backup with Compression`
```terminal
docker exec ${CONTAINER_ID} mongodump \
  --db course \
  --username root \
  --password 1122 \
  --authenticationDatabase admin \
  --gzip \
  --archive=/tmp/backup_$(date +%Y%m%d).gz
```
### <span class="text-secondary"> 2. Export to JSON (mongoexport)
#### `Export Collection to JSON`
```terminal
docker exec ${CONTAINER_ID} mongoexport \
  --db course \
  --collection students \
  --username root \
  --password 1122 \
  --authenticationDatabase admin \
  --out /tmp/students.json \
  --pretty
```
#### `Export with Query Filter`
```terminal
docker exec ${CONTAINER_ID} mongoexport \
  --db course \
  --collection students \
  --query '{ "grade": "A" }' \
  --username root \
  --password 1122 \
  --authenticationDatabase admin \
  --out /tmp/grade_a_students.json
```
### <span class="text-secondary">3. Copy Backup to Host
### <span style="color: var(--color-success);font-weigth">Windows
#### `Copy entire backup folder`
```terminal
docker cp ${CONTAINER_ID}:/tmp/backup_20231215 C:\Users\Agentos\Desktop\
```
#### `Copy single backup file`
```terminal
docker cp ${CONTAINER_ID}:/tmp/backup.gz C:\Users\Agentos\Desktop\
```
<span class="text-secondary">Linux/Mac

#### `Copy entire backup folder`
```terminal
docker cp ${CONTAINER_ID}:/tmp/backup_20231215 ~/Desktop/
```
#### `Copy single backup file`
```terminal
docker cp ${CONTAINER_ID}:/tmp/backup.gz ~/Desktop/
```
### <span class="text-secondary">Restore Operations
#### <span style="color: var(--color-success);font-weigth">1. Restore from Binary Backup
#### `Copy backup to container`
```terminal
docker cp ./backup_folder ${CONTAINER_ID}:/restore_data
```

#### `Restore Entire Database`
```terminal
docker exec ${CONTAINER_ID} mongorestore \
  --db course \
  --username root \
  --password 1122 \
  --authenticationDatabase admin \
  /restore_data/course
```  
#### `Restore with Drop Existing Data`
```terminal
docker exec ${CONTAINER_ID} mongorestore \
  --db course \
  --username root \
  --password 1122 \
  --authenticationDatabase admin \
  --drop \
  /restore_data/course
```
#### `Restore from Compressed Archive`
``` terminal
docker exec ${CONTAINER_ID} mongorestore \
  --db course \
  --username root \
  --password 1122 \
  --authenticationDatabase admin \
  --gzip \
  --archive=/restore_data/backup.gz
```
#### <span style="color: var(--color-success);font-weigth">2. Restore from JSON</sapn>
#### `Import JSON File`
```terminal
docker exec ${CONTAINER_ID} mongoimport \
  --db course \
  --collection restored_students \
  --file /restore_data/students.json \
  --jsonArray \
  --username root \
  --password 1122 \
  --authenticationDatabase admin
```
## <span class="text-secondary">Common MongoDB Commands
### <span style="color: var(--color-success);font-weigth">Database Operations</sapn>
#### `Create database (use it first)`
```bash
use new_database
```
#### `Current database name`
```bash
db.getName()
```
#### `Database stats`
  ```bash
db.stats()
```
#### `Drop current database`
```bash
db.dropDatabase()
```
### <span style="color: var(--color-success);font-weigth">Collection Operations
#### `Create collection explicitly`
```bash
db.createCollection("new_collection")
```
#### `Collection stats`
```bash
db.collection_name.stats()
```
#### `Drop collection`
```bash
db.collection_name.drop()
```
#### `Rename collection`
```bash
db.old_name.renameCollection("new_name")
```
### <span style="color: var(--color-success);font-weigth">Index Operations
#### `Create index`
```bash
db.students.createIndex({ name: 1 })
```
#### `Create unique index`
```bash
db.students.createIndex({ email: 1 }, { unique: true })
```
#### `Create compound index`
```bash
db.students.createIndex({ name: 1, age: -1 })
```
#### `List indexes`
```bash
db.students.getIndexes()
```
#### `Drop index`
```bash
db.students.dropIndex("name_1")
```
### <span class="text-secondary">Aggregation Examples
#### `Group by grade`
```bash
db.students.aggregate([
  { $group: { _id: "$grade", count: { $sum: 1 } } }
])
```
#### `Average age by grade`
```bash
db.students.aggregate([
  { $group: { 
    _id: "$grade", 
    averageAge: { $avg: "$age" },
    count: { $sum: 1 }
  }}
])
```
#### `Sort results`
```bash
db.students.aggregate([
  { $sort: { age: -1 } },
  { $limit: 10 }
])
```
### <span style="color: var(--color-success);font-weigth">Troubleshooting 
#### Connection Issues
#### `Test MongoDB connection`
```terminal
docker exec ${CONTAINER_ID} mongosh \
  --eval "db.adminCommand('ping')" \
  -u root -p 1122 --authenticationDatabase admin
```
#### `Check if port is accessible`
``terminal
telnet localhost 27017
```
#### `Check container status`
```terminal
docker inspect mongodb | grep Status
```
### <span style="color: var(--color-error);font-weigth">Authentication Errors
#### `Reset credentials` (recreate container)
```terminal
docker stop mongodb
docker rm mongodb
docker run ... # with new credentials
```
### <span style="color: var(--color-info);font-weigth">Check authentication logs
```terminal
docker logs mongodb | grep -i auth
```
### <span class="text-secondary">Backup/Restore Issues

#### `Check available space in container`
```terminal
docker exec ${CONTAINER_ID} df -h
```
#### `Verify backup file integrity`
```terminal
docker exec ${CONTAINER_ID} ls -lh /tmp/backup/
```
#### `Check MongoDB version compatibility`
```terminal
docker exec ${CONTAINER_ID} mongosh --version
```
## --- End ---