answer-assignment
=================

The Brief
---------

Create an answer creation/ reporting tool.

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
- Comment *(owner, content, createdBy, createdAt)*
- Attachment *(ID, path, size, extension)*
- Answer Search Stat *(answer_ID, searchedAt, searchTerm)*

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
