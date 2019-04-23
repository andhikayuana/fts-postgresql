-- create posts_v1
CREATE TABLE posts_v1 (
  id BIGSERIAL PRIMARY KEY,
  title VARCHAR NOT NULL,
  content VARCHAR NOT NULL,
  author VARCHAR NOT NULL
);

-- add new column to store tsvector value
ALTER TABLE posts_v1 ADD COLUMN content_tokens tsvector;

-- add index
CREATE index idx_content_search ON posts_v1 USING GIN(content_tokens);

-- trigger
CREATE OR REPLACE FUNCTION fun_insert_or_update_search_content() RETURNS TRIGGER AS $$
BEGIN
    UPDATE "posts_v1" SET "content_tokens" = to_tsvector(NEW.content)
    WHERE "id" = NEW.id;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_insert_or_update_search_content AFTER INSERT ON "posts_v1"
FOR EACH ROW EXECUTE PROCEDURE fun_insert_or_update_search_content();