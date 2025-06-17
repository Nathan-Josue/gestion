<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Catégories",
 *     description="Gestion des catégories"
 * )
 */
class CategoryController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/categories",
     *     summary="Lister toutes les catégories",
     *     tags={"Catégories"},
     *     @OA\Response(
     *         response=200,
     *         description="Liste des catégories"
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Category::all(), 200);
    }

    /**
     * @OA\Post(
     *     path="/api/categories",
     *     summary="Créer une nouvelle catégorie",
     *     tags={"Catégories"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Informatique")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Catégorie créée avec succès"
     *     ),
     *     @OA\Response(response=422, description="Validation échouée")
     * )
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        $category = Category::create($validatedData);

        return response()->json([
            'message' => 'Catégorie créée avec succès',
            'data' => $category,
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/categories/{id}",
     *     summary="Afficher une catégorie spécifique",
     *     tags={"Catégories"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Détails de la catégorie"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Catégorie non trouvée"
     *     )
     * )
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Catégorie non trouvée'], 404);
        }
        return response()->json($category, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/categories/{id}",
     *     summary="Mettre à jour une catégorie",
     *     tags={"Catégories"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Nouvelles technologies")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Catégorie mise à jour avec succès"
     *     ),
     *     @OA\Response(response=404, description="Catégorie non trouvée"),
     *     @OA\Response(response=422, description="Validation échouée")
     * )
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Catégorie non trouvée'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|unique:categories,name,' . $id . '|max:255',
        ]);

        $category->update($validatedData);

        return response()->json([
            'message' => 'Catégorie mise à jour avec succès',
            'data' => $category,
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/categories/{id}",
     *     summary="Supprimer une catégorie",
     *     tags={"Catégories"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Catégorie supprimée avec succès"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Catégorie non trouvée"
     *     )
     * )
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Catégorie non trouvée'], 404);
        }

        $category->delete();

        return response()->json([
            'message' => 'Catégorie supprimée avec succès'
        ], 200);
    }

}
