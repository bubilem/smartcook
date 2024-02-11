<?php

class RecipesController extends MainController
{

    private const ATTRIBUTES = [
        "id",
        "name",
        "difficulty",
        "duration",
        "price",
        "description",
        "country",
        "author"
    ];

    private const FILTERS = [
        "author",
        "dish_category",
        "recipe_category",
        "difficulty",
        "price",
        "tolerance",
        "ingredient"
    ];

    public function do(): void
    {
        /* ATTRIBUTES */
        if ($attr = $this->req->get("attributes")) {
            if (!is_array($attr)) {
                throw new Exception("Bad format for recipe attributes, it must be an array.");
            }
            $q_select = "";
            foreach ($attr as $val) {
                if (!in_array($val, self::ATTRIBUTES)) {
                    throw new Exception("Not supported attribute name: $val");
                }
                $q_select .= ($q_select ? ", " : "") . "r." . $val;
            }
        } else {
            $q_select = "r.id, r.name";
        }

        /* FILTER */
        $q_from = "recipe r";
        $q_where = "";
        $query_params = null;
        if ($filter = $this->req->get("filter")) {
            if (!is_array($filter)) {
                throw new Exception("Bad format for recipe filter, it must be an array.");
            }
            $str = new StructureModel;
            foreach ($filter as $name => $val) {
                if (!in_array($name, self::FILTERS)) {
                    throw new Exception("Not supported filter name: $name");
                }
                if (empty($val)) {
                    /* empty values pass and jump to next attribute... */
                    continue;
                }
                if (!is_array($val)) {
                    throw new Exception("Not supported filter value type for: $val, it must be an array.");
                }
                switch ($name) {
                    case "author":
                        $authors = "";
                        foreach ($val as $author) {
                            $authors .= ($authors ? ", " : "") . "'$author'";
                        }
                        $q_where .= ($q_where ? " AND " : "") . "r.author IN ($authors)";
                        break;
                    case "dish_category":
                        if (!$str->keysExist($val, "dish_category")) {
                            throw new Exception("Not supported key for dish_category.");
                        }
                        $q_from .= " JOIN recipe_has_dish_category rhdc ON r.id = rhdc.recipe_id";
                        $q_where .= ($q_where ? " AND " : "") . "rhdc.dish_category_id IN (" . implode(",", $val) . ")";
                        break;
                    case "recipe_category":
                        if (!$str->keysExist($val, "recipe_category")) {
                            throw new Exception("Not supported key for recipe_category.");
                        }
                        $q_from .= " JOIN recipe_has_category rhc ON r.id = rhc.recipe_id";
                        $q_where .= ($q_where ? " AND " : "") . "rhc.recipe_category_id IN (" . implode(",", $val) . ")";
                        break;
                    case "difficulty":
                        if (!$str->keysExist($val, "difficulty")) {
                            throw new Exception("Not supported key for difficulty.");
                        }
                        $q_where .= ($q_where ? " AND " : "") . "r.difficulty IN (" . implode(",", $val) . ")";
                        break;
                    case "price":
                        if (!$str->keysExist($val, "price")) {
                            throw new Exception("Not supported key for price.");
                        }
                        $q_where .= ($q_where ? " AND " : "") . "r.price IN (" . implode(",", $val) . ")";
                        break;
                    case "tolerance":
                        if (!$str->keysExist($val, "tolerance")) {
                            throw new Exception("Not supported key for tolerance.");
                        }
                        $q_from .= " JOIN recipe_has_tolerance rht ON r.id = rht.recipe_id";
                        $q_where .= ($q_where ? " AND " : "") . "rht.tolerance_id IN (" . implode(",", $val) . ")";
                        break;
                    case "ingredient":
                        foreach ($val as $v) {
                            if (!is_int($v) || $v < 0) {
                                throw new Exception("Ingredient value must be a positive integer.");
                            }
                        }
                        $q_from .= " JOIN recipe_has_ingredient rhi ON r.id = rhi.recipe_id";
                        $q_where .= ($q_where ? " AND " : "") . "rhi.ingredient_id IN (" . implode(",", $val) . ")";
                        break;
                }
            }
        }
        $query = "SELECT $q_select FROM $q_from" . ($q_where ? " WHERE $q_where" : "") . " ORDER BY r.name";
        $recipes = DB::query($query, $query_params)->fetchAll();
        $this->res
            ->set('stat', 'ok')
            ->set('data', $recipes);
    }

}
