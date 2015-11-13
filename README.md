answer-assignment
=================

Usage
-----

Run the script ```scripts/setup.sh``` to set up the database, entities and test data.

Status
------

**INCOMPLETE**

To-do:

- set up restful routes, ensuring SSL usage
- set up restful test client
- set up PHPUnit
- restful API handling

The Brief
---------

Create an answer creation/ reporting tool.

Analysis
========

In Scope
--------

Answers can:

- be created
  - with attachments
  - without attachments
- be viewed
- be searched for
- be commented upon
  - with attachments
  - without attachments
- be reported upon
- be viewed by recency
- be viewed by frequency of search results

Out of Scope
------------

Answers, comments and file uploads **cannot**:

- be deleted
- be amended

Assumptions
===========

- the API will only be available to *authorised* users
- a simple authentication scheme will be used
- Not being able to use symfony/form directly **does not** rule out using FOSRestBundle (which itself depends on symfony/form)

Considerations
==============

- file upload security
- user authentication
- enforce SSL for API
- logging
- testing: API + web
- fixtures

Model
=====

Basic Information
-----------------

- Answer *(ID, title, content, createdBy, createdAt)*
  - *assumption*: titles should be unique - no point allowing duplicate answers
- Comment *(owner, content, createdBy, createdAt)*
- Attachment *(ID, path, size, extension)*
- Answer Search Stat *(answer_ID, searchedAt)*

Model
-----

         ANSWER SEARCH STAT
          /
        has
       /
    ANSWER -has- COMMENT
       \           /
        has     has
          \     /
        ATTACHMENT


SETUP
=====

Run: ```scripts/setup.sh```

This will set up the database and populate it with dummy data.

*Note:* Since the project has been set-up with UTF8 in mind (and using MySQL), so it's probably best to amend the MySQL config file as follows:

    [mysqld]
    # Version 5.5.3 introduced "utf8mb4", which is recommended
    collation-server     = utf8mb4_general_ci
    character-set-server = utf8mb4