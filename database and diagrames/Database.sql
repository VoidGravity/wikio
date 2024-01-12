CREATE TABLE
    users (
        id INT auto_increment primary key,
        username varchar(244),
        email varchar(244),
        password varchar(244),
        Role ENUM ('author', 'admin') DEFAULT 'author'
    );

CREATE TABLE
    categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        Nom VARCHAR(140) NOT NULL
    );

CREATE TABLE
    wikis (
        id INT auto_increment primary key,
        title varchar(244),
        description varchar(244),
        content text,
        creationDate DATETIME DEFAULT CURRENT_TIMESTAMP,
        updateDate DATETIME,
        AuthorId INT,
        CategorieId INT
    );

CREATE TABLE
    tags (
        id INT AUTO_INCREMENT PRIMARY KEY,
        Nom VARCHAR(255) NOT NULL
    );

CREATE TABLE
    wikiTag (WikiId INT, TagId INT);

ALTER TABLE wikiTag ADD FOREIGN KEY (WikiId) REFERENCES wikis (id),
ADD FOREIGN KEY (TagId) REFERENCES tags (id);

ALTER TABLE wikis ADD FOREIGN KEY (AuthorId) REFERENCES users (id),
ADD FOREIGN KEY (CategorieId) REFERENCES categories (id);


-- data insertion
INSERT INTO
    users (username, email, password, Role)
VALUES
    (
        'johndoe1Au',
        'johndoe@example.com',
        'Azerazer1234',
        'author'
    ),
    (
        'janedoeAd',
        'janedoe@example.com',
        'Azerazer1234',
        'admin'
    ),
    (
        'janedoe2Au',
        'janedoe@example.com',
        'Azerazer1234',
        'author'
    );

INSERT INTO
    categories (Nom)
VALUES
    ('Tech'),
    ('travel'),
    ('sci-fi');

INSERT INTO
    wikis (
        title,
        description,
        content,
        AuthorId,
        CategorieId
    )
VALUES
    (
        'title 1',
        'test description 1',
        'test content 1',
        1,
        1
    ),
    (
        'title 2',
        'Description 2',
        'Content 2', 
        3,
        2
    ),
    (
        'title 3',
        'Description 3',
        'Content 3',
        2,
        3
    );



INSERT INTO
    tags (Nom)
VALUES
    ('lorem ipsum'),
    ('lorem ipsum'),
    ('lorem ipsum');

INSERT INTO
    wikiTag (WikiId, TagId)
VALUES
    (4, 1),
    (7, 2),
    (6, 3);

-- search query
SELECT
    *,
    wikis.id as WikiId
FROM
    wikis
    JOIN users ON wikis.AuthorId = users.id
WHERE
    title LIKE '%$search%'
    OR description LIKE '%$search%'
    OR content LIKE '%$search%'
LIMIT
    3
OFFSET
    2;