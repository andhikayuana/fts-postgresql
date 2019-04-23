-- search query using LIKE
-- EXPLAIN ANALYZE
SELECT *
FROM posts_v1 p
WHERE LOWER(p.content) LIKE '%selamat%';

-- search query using ILIKE
SELECT *
FROM posts_v1 p
WHERE p.content ILIKE '%selamat%';

-- search using ts_vector
SELECT *
FROM posts_v1 p
WHERE to_tsvector(p.content) @@ to_tsquery('selamat');

-- search using ts_vector stored in columnd
SELECT *
FROM posts_v1 p
WHERE p.content_tokens @@ to_tsquery('selamat')
