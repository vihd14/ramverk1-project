--
-- Creating a sample table.
--



--
-- Table Comments
--
DROP TABLE IF EXISTS Comments;
CREATE TABLE Comments (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "email" TEXT,
    "text" TEXT
);
