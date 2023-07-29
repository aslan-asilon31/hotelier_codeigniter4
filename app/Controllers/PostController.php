<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Post;

class PostController extends BaseController
{
    public function index()
    {
        //model initialize
        $postModel = new Post();

        //pager initialize
        $pager = \Config\Services::pager();

        $data = array(
            'posts' => $postModel->paginate(5, 'post'),
            'pager' => $postModel->pager
        );

        return view('Posts\index', $data);
    }

    public function create()
    {
        return view('Posts\create');
    }

    
    public function store()
    {
        // Load helper form and URL
        helper(['form', 'url']);
         
        // Define validation rules
        $validationRules = [
            'title' => 'required',
            'content' => 'required',
            'image' => [
                'rules' => 'uploaded[image]|max_size[image,1024]|is_image[image]',
                'errors' => [
                    'uploaded' => 'Please choose an image to upload.',
                    'max_size' => 'The image size should not exceed 1MB.',
                    'is_image' => 'Only image files (jpeg, png, gif) are allowed.',
                ],
            ],
        ];
    
        if (!$this->validate($validationRules)) {
            // Render view with error validation message
            return view('Posts\create', [
                'validation' => $this->validator
            ]);
        } else {
            // Get the uploaded image file
            $image = $this->request->getFile('image');
    
            // Generate a random name for the image
            $imageName = $image->getRandomName();
    
            // Move the uploaded image to the 'uploads' directory
            $image->move(ROOTPATH . 'public/uploads', $imageName);
    
            // Model initialize
            $postModel = new Post();
    
            // Insert data into the database
            $postModel->insert([
                'title'   => $this->request->getPost('title'),
                'content' => $this->request->getPost('content'),
                'image' => $imageName,
            ]);
    
            // Flash message
            session()->setFlashdata('message', 'Post Berhasil Disimpan');
    
            return redirect()->to(base_url('posts')); // Correct the route to 'posts'
        }
    }
    

    public function edit($id)
    {
        // Model initialize
        $postModel = new Post();
    
        // Find the Post by ID
        $data = [
            'post' => $postModel->find($id)
        ];
    
        return view('Posts\edit', $data);
    }
    

    public function update($id)
    {
        // Load helper form and URL
        helper(['form', 'url']);
        
        // Define validation
        $validation = $this->validate([
            'title' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan Judul Post.'
                ]
            ],
            'content' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan konten Post.'
                ]
            ],
            'image' => [
                'rules' => 'uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Please choose an image to upload.',
                    'mime_in' => 'Only JPEG or PNG images are allowed.',
                ],
            ],
        ]);
    
        if (!$validation) {
            // Model initialize
            $postModel = new Post();
    
            // Render view with error validation message
            return view('Posts\edit', [
                'post' => $postModel->find($id),
                'validation' => $this->validator
            ]);
        } else {
            // Model initialize
            $postModel = new Post();
    
            // Get the uploaded image
            $image = $this->request->getFile('image');
            if ($image->isValid() && !$image->hasMoved()) {
                // Generate a random name for the image to avoid name conflicts
                $newName = $image->getRandomName();
    
                // Move the uploaded image to the "uploads" directory
                $image->move(ROOTPATH . 'public/uploads', $newName);
    
                // Delete the old image (optional)
                // $oldImage = $postModel->find($id)['image'];
                // if ($oldImage && file_exists(ROOTPATH . 'public/uploads/' . $oldImage)) {
                //     unlink(ROOTPATH . 'public/uploads/' . $oldImage);
                // }
            } else {
                // Use the existing image name from the database if no new image was uploaded
                $newName = $postModel->find($id)['image'];
            }
    
            // Update data in the database
            $postModel->update($id, [
                'title'   => $this->request->getPost('title'),
                'content' => $this->request->getPost('content'),
                'image'   => $newName,
            ]);
    
            // Flash message
            session()->setFlashdata('message', 'Post Berhasil Diupdate');
    
            return redirect()->to(base_url('posts'));
        }
    }
    

    public function delete($id)
    {
        //model initialize
        $postModel = new Post();

        // Delete the post
        $postModel->delete($id);

        //flash message
        session()->setFlashdata('message', 'Post Berhasil Dihapus');

        return redirect()->to(base_url('posts'));
    }




}
