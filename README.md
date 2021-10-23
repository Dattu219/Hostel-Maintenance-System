# Hostel-Maintenance-System

## Introduction
```
This is a community-based project designed in the view of R.V.R & J.C College of Engineering hostel mess maintenance. This website consists of adding and editing of stocks maintained in hostel mess and viewing stats and reports. It is easy to use and every hostel staff can utilize it in an efficient manner.
```

## Installation
```
Install mysql and php. Make sure you allow root access and put an empty password for mysql while installing.
```

## Database
Use following commands
1. To create databases
```
create database users;
create database items;
```
2. Importing table schemas
```
mysql -u root -p users < ./database/users.sql
mysql -u root -p items < ./database/items.sql
```