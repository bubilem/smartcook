# Recipe

[HOME](README.md)

| name          | datatype  | example                    | description                                       |
| ------------- | --------- | -------------------------- | ------------------------------------------------- |
| id            | int       | 1                          | unique id                                         |
| name          | string    | "Earl Grey"                | unique name                                       |
| difficulty    | int       | 1                          | [list](../database/smartcook_data_structure.json) |
| duration      | int       | 5                          | minutes                                           |
| price         | int       | 1                          | [list](../database/smartcook_data_structure.json) |
| description   | string    | "We will prepare a cup..." | procedure                                         |
| country       | string(2) | "uk"                       | ISO 3166 alpha-2                                  |
| dish_category | array     | [1, 5]                     | [list](../database/smartcook_data_structure.json) |
| dish_category | array     | [9]                        | [list](../database/smartcook_data_structure.json) |
| tolerance     | array     | [1]                        | [list](../database/smartcook_data_structure.json) |
| ingredient    | array     | []                         |                                                   |
| author        | string    | "Test User"                | author of the recipe                              |
