SELECT setval('authors_author_id_seq', max(author_id))
FROM authors;
SELECT setval('books_book_id_seq', max(book_id))
FROM books;
SELECT setval('publishers_publisher_id_seq', max(publisher_id))
FROM publishers;
SELECT setval('venues_id_seq', max(id))
FROM venues;
SELECT setval('events_id_seq', max(id))
FROM events;
SELECT setval('hosts_id_seq', max(id))
FROM hosts;
SELECT setval('employees_id_seq', max(id))
FROM employees;
SELECT setval('positions_id_seq', max(id))
FROM positions;
SELECT setval('"rm-bldg_rm-id_seq"', max("rm-id"))
FROM "rm-bldg";
SELECT setval('awesome_people_id_seq', max(id))
FROM awesome_people;
SELECT setval('amenities_amenity_id_seq', max(amenity_id))
FROM amenities;
SELECT setval('property_property_id_seq', max(property_id))
FROM property;
SELECT setval('property_amenities_id_seq', max(id))
FROM property_amenities;
SELECT setval('users_id_seq', max(id))
FROM users;
SELECT setval('newsletters_id_seq', max(id))
FROM newsletters;
SELECT setval('user_newsletters_id_seq', max(id))
FROM user_newsletters;
SELECT setval('valuestore_id_seq', max(id))
FROM valuestore;
