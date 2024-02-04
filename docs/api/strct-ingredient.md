# Ingredient

[HOME](README.md)

| name      | datatype | example                  | description                                       |
| --------- | -------- | ------------------------ | ------------------------------------------------- |
| id        | int      | 1                        | unique id                                         |
| name      | string   | "Earl Grey"              | unique name                                       |
| quantity  | numeric  | 3.5                      | numerical expression of quantity                  |
| unit      | int      | 1                        | [list](../database/smartcook_data_structure.json) |
| necessary | int      | 0                        | 0(not necessary) or 1 (necessary)                 |
| comment   | string   | "You can also use honey" | optional                                          |

## Examples

- [recipe stored in the database](../database/smartcook_recipe.json)
- [new recipe withou id for inserting to database](../database/smartcook_recipe_new.json)
