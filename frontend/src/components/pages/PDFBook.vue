<template>
  <div class="content-wrapper">
    <!-- Header Section -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-3">
          <div class="col-sm-6">
            <h1 class="text-gradient">
              <i class="fa fa-book mr-2"></i> PDF Books Management
            </h1>
          </div>
          <div class="col-sm-6">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb float-sm-right bg-transparent">
                <li class="breadcrumb-item">
                  <router-link :to="{ name: 'dashboard' }" class="text-decoration-none">
                    <i class="fa fa-home"></i> Home
                  </router-link>
                </li>
                <li class="breadcrumb-item active">
                  <i class="fa fa-file-pdf"></i> PDF Books
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>

    <!-- Main Content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Stats Cards -->
        <div class="row mb-4">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-info">
              <div class="inner">
                <h3>{{ stats.totalBooks }}</h3>
                <p>Total Books</p>
              </div>
              <div class="icon">
                <i class="fa fa-book-open"></i>
              </div>
              <div class="small-box-footer">
                <i class="fa fa-arrow-circle-right"></i> View All
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-success">
              <div class="inner">
                <h3>{{ stats.activeBooks }}</h3>
                <p>Active Books</p>
              </div>
              <div class="icon">
                <i class="fa fa-check-circle"></i>
              </div>
              <div class="small-box-footer">
                <i class="fa fa-arrow-circle-right"></i> View Active
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-warning">
              <div class="inner">
                <h3>{{ stats.totalDownloads }}</h3>
                <p>Total Downloads</p>
              </div>
              <div class="icon">
                <i class="fa fa-download"></i>
              </div>
              <div class="small-box-footer">
                <i class="fa fa-arrow-circle-right"></i> View Stats
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-danger">
              <div class="inner">
                <h3>{{ stats.categories }}</h3>
                <p>Categories</p>
              </div>
              <div class="icon">
                <i class="fa fa-folder"></i>
              </div>
              <div class="small-box-footer">
                <i class="fa fa-arrow-circle-right"></i> Manage
              </div>
            </div>
          </div>
        </div>

        <!-- Filter Card -->

<!-- Filter Card -->
<div class="card card-outline card-primary shadow-sm mb-4">
  <div class="card-header">
    <h3 class="card-title">
      <i class="fa fa-filter mr-2"></i> Filter & Search
    </h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fa fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="card-body">
    <div class="row">
      <!-- Category Filter -->
      <div class="col-md-3">
        <div class="form-group">
          <label>
            <i class="fa fa-folder-open mr-1 text-primary"></i> Category
          </label>
          <select class="form-control form-control-sm" v-model="filters.category_id" @change="applyFilters">
            <option value="">All Categories</option>
            <option v-for="cat in categories" :key="cat.id" :value="cat.id">
              {{ cat.title }}
            </option>
          </select>
        </div>
      </div>

      <!-- Status Filter -->
      <div class="col-md-3">
        <div class="form-group">
          <label>
            <i class="fa fa-toggle-on mr-1 text-success"></i> Status
          </label>
          <select class="form-control form-control-sm" v-model="filters.status" @change="applyFilters">
            <option value="">All</option>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
          </select>
        </div>
      </div>

      <!-- Search Input -->
      <div class="col-md-4">
        <div class="form-group">
          <label>
            <i class="fa fa-search mr-1 text-info"></i> Search
          </label>
          <div class="input-group input-group-sm">
            <input type="text" class="form-control" v-model="filters.search"
                   placeholder="Search by title or description..."
                   @keyup.enter="applyFilters">
            <div class="input-group-append">
              <button class="btn btn-primary" @click="applyFilters">
                <i class="fa fa-search"></i> Search
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Reset Button -->
      <div class="col-md-2 d-flex align-items-end">
        <div class="form-group w-100">
          <label class="invisible">Reset</label>
          <button class="btn btn-secondary btn-sm w-100" @click="resetFilters">
            <i class="fa fa-undo mr-1"></i> Reset
          </button>
        </div>
      </div>
    </div>
  </div>
</div>



        <!-- --------------------------- -->
        <!-- Books Table Card -->
        <div class="card card-outline card-primary shadow">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fa fa-list mr-2"></i> Books List
            </h3>
            <div class="card-tools">
              <button class="btn btn-success btn-sm" @click="showBookModal">
                <i class="fa fa-plus-circle mr-1"></i> Add New Book
              </button>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover table-striped mb-0">
                <thead class="bg-light">
                  <tr>
                    <th width="50">#</th>
                    <th width="80">Cover</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Version</th>
                    <th>Status</th>
                    <th>Downloads</th>
                    <th>Created</th>
                    <th width="200">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(book, index) in books" :key="book.id"
                      :class="{ 'bg-light': !book.status }">
                    <td>{{ getSerialNumber(index) }}</td>
                    <td>
                      <img :src="book.image_url || 'https://via.placeholder.com/50x70?text=No+Cover'"
                           :alt="book.title"
                           class="img-thumbnail"
                           style="width: 50px; height: 70px; object-fit: cover;">
                    </td>
                    <td>
                      <strong>{{ book.title }}</strong>
                      <br>
                      <small class="text-muted">{{ truncateText(book.description, 50) }}</small>
                    </td>
                    <td>
                      <span class="badge badge-info">
                        <i class="fa fa-folder mr-1"></i>
                        {{ book.category?.title || 'N/A' }}
                      </span>
                    </td>
                    <td>
                      <span class="badge badge-secondary">v{{ book.version || '1.0' }}</span>
                    </td>
                    <td>
                      <span :class="`badge badge-${book.status ? 'success' : 'danger'}`">
                        <i :class="`fa fa-${book.status ? 'check' : 'times'}-circle mr-1`"></i>
                        {{ book.status ? 'Active' : 'Inactive' }}
                      </span>
                    </td>
                    <td>
                      <span class="badge badge-primary">
                        <i class="fa fa-download mr-1"></i> {{ book.downloads || 0 }}
                      </span>
                    </td>
                    <td>
                      <small>
                        <i class="fa fa-calendar mr-1"></i>
                        {{ formatDate(book.created_at) }}
                      </small>
                    </td>
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-sm btn-info" @click="viewBook(book.id)" title="View/Edit">
                          <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-primary" @click="downloadBook(book.id)" title="Download">
                          <i class="fa fa-download"></i>
                        </button>
                        <button :class="`btn btn-sm btn-${book.status ? 'warning' : 'success'}`"
                                @click="toggleStatus(book.id)"
                                :title="book.status ? 'Deactivate' : 'Activate'">
                          <i :class="`fa fa-${book.status ? 'ban' : 'check'}`"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" @click="removeBook(book.id)" title="Delete">
                          <i class="fa fa-trash"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                  <tr v-if="books.length === 0">
                    <td colspan="9" class="text-center py-5">
                      <div class="empty-state">
                        <i class="fa fa-book-open fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">No Books Found</h5>
                        <p class="text-muted">Click "Add New Book" to create your first book.</p>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer clearfix" v-if="pagination && pagination.total > 0">
            <div class="row">
              <div class="col-sm-6">
                <span class="text-muted">
                  Showing {{ pagination.from || 0 }} to {{ pagination.to || 0 }} of {{ pagination.total || 0 }} entries
                </span>
              </div>
              <div class="col-sm-6">
                <nav aria-label="Page navigation" class="float-right">
                  <ul class="pagination pagination-sm m-0">
                    <li class="page-item" :class="{ disabled: pagination.current_page === 1 }">
                      <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page - 1)">
                        <i class="fa fa-chevron-left"></i>
                      </a>
                    </li>
                    <li class="page-item" v-for="page in pagination.last_page" :key="page"
                        :class="{ active: page === pagination.current_page }">
                      <a class="page-link" href="#" @click.prevent="changePage(page)">{{ page }}</a>
                    </li>
                    <li class="page-item" :class="{ disabled: pagination.current_page === pagination.last_page }">
                      <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page + 1)">
                        <i class="fa fa-chevron-right"></i>
                      </a>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Book Modal -->
    <div class="modal fade" ref="bookModal" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-gradient-primary">
            <h5 class="modal-title text-white">
              <i :class="`fa fa-${bookObject.id ? 'edit' : 'plus-circle'} mr-2`"></i>
              {{ bookObject.id ? 'Edit' : 'Create New' }} PDF Book
            </h5>
            <button type="button" class="close text-white" @click="hideBookModal">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <!-- Fixed: Use correct submit handler based on mode -->
          <form @submit.prevent="bookObject.id ? updateBook() : createBook()" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-8">
                  <!-- Title -->
                  <div class="form-group">
                    <label class="required-field">
                      <i class="fa fa-heading mr-1 text-primary"></i> Title
                    </label>
                    <input type="text" class="form-control" v-model="bookObject.title"
                           :class="{ 'is-invalid': bookObjectErr.title }"
                           placeholder="Enter book title">
                    <div class="invalid-feedback">{{ bookObjectErr.title }}</div>
                  </div>

                  <!-- Category & Version -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="required-field">
                          <i class="fa fa-folder mr-1 text-warning"></i> Category
                        </label>
                        <select class="form-control" v-model="bookObject.category_id"
                                :class="{ 'is-invalid': bookObjectErr.category_id }">
                          <option value="">Select Category</option>
                          <option v-for="cat in categories" :key="cat.id" :value="cat.id">
                            {{ cat.title }}
                          </option>
                        </select>
                        <div class="invalid-feedback">{{ bookObjectErr.category_id }}</div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>
                          <i class="fa fa-tag mr-1 text-info"></i> Version
                        </label>
                        <input type="text" class="form-control" v-model="bookObject.version"
                               :class="{ 'is-invalid': bookObjectErr.version }"
                               placeholder="1.0.0">
                        <div class="invalid-feedback">{{ bookObjectErr.version }}</div>
                      </div>
                    </div>
                  </div>

                  <!-- Description -->
                  <div class="form-group">
                    <label>
                      <i class="fa fa-align-left mr-1 text-success"></i> Description
                    </label>
                    <textarea class="form-control" v-model="bookObject.description"
                              :class="{ 'is-invalid': bookObjectErr.description }"
                              rows="4" placeholder="Enter book description"></textarea>
                    <div class="invalid-feedback">{{ bookObjectErr.description }}</div>
                  </div>

                  <!-- Status -->
                  <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input"
                             id="statusSwitch" v-model="bookObject.status">
                      <label class="custom-control-label" for="statusSwitch">
                        <i class="fa fa-power-off mr-1"></i> Active Status
                      </label>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <!-- Cover Image -->
                  <div class="form-group text-center">
                    <label>
                      <i class="fa fa-image mr-1 text-purple"></i> Cover Image
                    </label>
                    <div class="image-upload-wrapper mb-2">
                      <img :src="imagePreview || bookObject.image_url || 'https://via.placeholder.com/200x250?text=No+Cover'"
                           class="img-thumbnail mb-2" style="max-height: 150px;">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image"
                               ref="imageInput" @change="handleImageUpload" accept="image/*">
                        <label class="custom-file-label" for="image">
                          {{ imageFileName || 'Choose image...' }}
                        </label>
                      </div>
                      <small class="text-muted">Max: 2MB (jpeg, png, jpg, gif)</small>
                    </div>
                  </div>

                  <!-- PDF File -->
                  <div class="form-group text-center">
                    <label class="required-field">
                      <i class="fa fa-file-pdf mr-1 text-danger"></i> PDF File
                    </label>
                    <div class="file-upload-wrapper">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file"
                               ref="fileInput" @change="handleFileUpload" accept=".pdf"
                               :required="!bookObject.id"> <!-- Required only for new books -->
                        <label class="custom-file-label" for="file">
                          {{ fileFileName || 'Choose PDF...' }}
                        </label>
                      </div>
                      <small class="text-muted">Max: 10MB (PDF only)</small>
                    </div>
                    <div v-if="bookObject.file_url && !fileFile" class="mt-2">
                      <a :href="bookObject.download_url" target="_blank" class="btn btn-sm btn-info">
                        <i class="fa fa-eye"></i> View Current PDF
                      </a>
                    </div>
                    <div v-if="bookObjectErr.file" class="text-danger small mt-1">
                      {{ bookObjectErr.file }}
                    </div>
                  </div>
                </div>
              </div>

              <!-- Statistics (View Only) -->
              <div v-if="bookObject.id" class="row mt-3 bg-light p-3 rounded">
                <div class="col-4 text-center">
                  <div class="stat-box">
                    <span class="stat-value">{{ bookObject.downloads || 0 }}</span>
                    <span class="stat-label">Downloads</span>
                  </div>
                </div>
                <div class="col-4 text-center">
                  <div class="stat-box">
                    <span class="stat-value">{{ bookObject.userview || 0 }}</span>
                    <span class="stat-label">Views</span>
                  </div>
                </div>
                <div class="col-4 text-center">
                  <div class="stat-box">
                    <span class="stat-value">{{ formatDate(bookObject.created_at, 'short') }}</span>
                    <span class="stat-label">Created</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer bg-light">
              <button type="button" class="btn btn-secondary" @click="hideBookModal">
                <i class="fa fa-times mr-1"></i> Cancel
              </button>
              <button type="submit" class="btn btn-primary" :disabled="saving">
                <i v-if="saving" class="fa fa-spinner fa-spin mr-1"></i>
                <i v-else class="fa fa-save mr-1"></i>
                {{ saving ? 'Saving...' : 'Save Changes' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted, computed } from "vue";
import Swal from 'sweetalert2';
import { CloseModal, LoadingModal, MessageModal } from "@func/swal";
import {
  apiGetPDFBook,
  apiGetPDFBookID,
  apiCreatePDFBook,
  apiUpdatePDFBook,
  apiDeletePDFBook,
  apiTogglePDFBookStatus,
  apiDownloadPDFBookID,
  apiGetCategories
} from "@func/api/pdfbook";

// Refs
const bookModal = ref(null);
const imageInput = ref(null);
const fileInput = ref(null);

// Data
const books = ref([]);
const categories = ref([]);
const loading = ref(false);
const saving = ref(false);
const imageFile = ref(null);
const fileFile = ref(null);
const imageFileName = ref('');
const fileFileName = ref('');
const imagePreview = ref(null);
const pagination = ref({
  current_page: 1,
  last_page: 1,
  total: 0,
  from: 0,
  to: 0,
  per_page: 15
});

// Stats
const stats = computed(() => {
  const total = books.value.length;
  const active = books.value.filter(b => b.status).length;
  const downloads = books.value.reduce((sum, b) => sum + (b.downloads || 0), 0);
  return {
    totalBooks: total,
    activeBooks: active,
    totalDownloads: downloads,
    categories: categories.value.length
  };
});

// Filters
const filters = reactive({
  category_id: '',
  status: '',
  search: ''
});

// Book object
const bookObject = reactive({
  id: null,
  title: '',
  description: '',
  category_id: '',
  status: true, // Default to active
  version: '1.0.0',
  downloads: 0,
  userview: 0,
  image_url: '',
  file_url: '',
  download_url: '',
  category: null,
  created_at: '',
  updated_at: ''
});

const bookObjectErr = reactive({
  title: '',
  description: '',
  category_id: '',
  version: '',
  image: '',
  file: ''
});

const defaultBookObject = JSON.parse(JSON.stringify(bookObject));
const defaultBookObjectErr = JSON.parse(JSON.stringify(bookObjectErr));

// Lifecycle
onMounted(async () => {
  // Initialize modal events
  if (bookModal.value) {
    $(bookModal.value).on("hide.bs.modal", resetData);
  }

  await loadCategories();
  await loadBooks();
});

// Methods
async function loadBooks() {
  loading.value = true;
  try {
    LoadingModal();

    const params = {
      page: pagination.value.current_page,
      per_page: pagination.value.per_page
    };

    // Add filters if they have values
    if (filters.category_id) params.category_id = filters.category_id;
    if (filters.status !== '') params.status = filters.status;
    if (filters.search) params.search = filters.search;

    const response = await apiGetPDFBook(params);

    // Handle response based on structure
    if (response.data?.data) {
      if (response.data.data.data) {
        // Paginated response with data wrapper
        books.value = response.data.data.data;
        pagination.value = {
          current_page: response.data.data.current_page,
          last_page: response.data.data.last_page,
          total: response.data.data.total,
          from: response.data.data.from,
          to: response.data.data.to,
          per_page: response.data.data.per_page
        };
      } else if (Array.isArray(response.data.data)) {
        // Simple array response
        books.value = response.data.data;
      } else {
        books.value = [];
      }
    } else {
      books.value = [];
    }

    CloseModal();
  } catch (error) {
    console.error('Load books error:', error);
    MessageModal("error", "Error", error.response?.data?.message || "Failed to load books");
  } finally {
    loading.value = false;
  }
}

async function loadCategories() {
  try {
    const response = await apiGetCategories();
    categories.value = response.data?.data || [];
  } catch (error) {
    console.error("Failed to load categories:", error);
    categories.value = [];
  }
}

// IMPORTANT FIX: Create new book
async function createBook() {
  try {
    // Clear previous errors
    Object.keys(bookObjectErr).forEach(key => {
      bookObjectErr[key] = '';
    });

    // Validate required fields
    if (!bookObject.title) {
      bookObjectErr.title = 'Title is required';
      return;
    }

    if (!bookObject.category_id) {
      bookObjectErr.category_id = 'Category is required';
      return;
    }

    if (!fileFile.value) {
      bookObjectErr.file = 'PDF file is required';
      return;
    }

    saving.value = true;
    LoadingModal();

    const formData = new FormData();
    formData.append('title', bookObject.title.trim());
    formData.append('description', bookObject.description?.trim() || '');
    formData.append('category_id', bookObject.category_id);
    formData.append('status', bookObject.status ? '1' : '0');
    formData.append('version', bookObject.version?.trim() || '1.0.0');

    // Append files if they exist
    if (imageFile.value) {
      formData.append('image', imageFile.value);
    }

    if (fileFile.value) {
      formData.append('file', fileFile.value);
    }

    // Log FormData for debugging
    for (let pair of formData.entries()) {
      console.log(pair[0] + ': ' + pair[1]);
    }

    const response = await apiCreatePDFBook(formData);

    if (response.data?.success) {
      hideBookModal();
      MessageModal("success", "Success", response.data?.message || 'Book created successfully');
      await loadBooks();
    } else {
      throw new Error(response.data?.message || 'Failed to create book');
    }
  } catch (error) {
    console.error('Create book error:', error);
    if (error.response?.status === 422) {
      const errors = error.response.data.errors || {};
      Object.keys(bookObjectErr).forEach(key => {
        bookObjectErr[key] = errors[key]?.[0] || '';
      });
      // Show validation errors
      MessageModal("error", "Validation Error", "Please check the form for errors");
    } else {
      MessageModal("error", "Error", error.response?.data?.message || error.message || 'Failed to create book');
    }
  } finally {
    saving.value = false;
    CloseModal();
  }
}

// IMPORTANT FIX: Update existing book
async function updateBook() {
  try {
    // Clear previous errors
    Object.keys(bookObjectErr).forEach(key => {
      bookObjectErr[key] = '';
    });

    // Validate required fields
    if (!bookObject.title) {
      bookObjectErr.title = 'Title is required';
      return;
    }

    if (!bookObject.category_id) {
      bookObjectErr.category_id = 'Category is required';
      return;
    }

    saving.value = true;
    LoadingModal();

    const formData = new FormData();
    formData.append('title', bookObject.title.trim());
    formData.append('description', bookObject.description?.trim() || '');
    formData.append('category_id', bookObject.category_id);
    formData.append('status', bookObject.status ? '1' : '0');
    formData.append('version', bookObject.version?.trim() || '1.0.0');

    // Add _method=PUT for update (Laravel requirement for file uploads)
    formData.append('_method', 'PUT');

    // Only append image if a new one is selected
    if (imageFile.value) {
      formData.append('image', imageFile.value);
    }

    // Only append file if a new one is selected
    if (fileFile.value) {
      formData.append('file', fileFile.value);
    }

    // Log FormData for debugging
    for (let pair of formData.entries()) {
      console.log(pair[0] + ': ' + pair[1]);
    }

    const response = await apiUpdatePDFBook(bookObject.id, formData);

    if (response.data?.success) {
      hideBookModal();
      MessageModal("success", "Success", response.data?.message || 'Book updated successfully');
      await loadBooks();
    } else {
      throw new Error(response.data?.message || 'Failed to update book');
    }
  } catch (error) {
    console.error('Update book error:', error);
    if (error.response?.status === 422) {
      const errors = error.response.data.errors || {};
      Object.keys(bookObjectErr).forEach(key => {
        bookObjectErr[key] = errors[key]?.[0] || '';
      });
      // Show validation errors
      MessageModal("error", "Validation Error", "Please check the form for errors");
    } else {
      MessageModal("error", "Error", error.response?.data?.message || error.message || 'Failed to update book');
    }
  } finally {
    saving.value = false;
    CloseModal();
  }
}

// Fixed: View book
async function viewBook(id) {
  try {
    LoadingModal();
    const response = await apiGetPDFBookID(id);

    if (!response.data?.success && !response.data?.data) {
      throw new Error('Invalid response format');
    }

    // Handle different response structures
    const bookData = response.data?.data || response.data;

    // Reset form first
    resetData();

    // Assign book data to form
    Object.assign(bookObject, {
      id: bookData.id,
      title: bookData.title || '',
      description: bookData.description || '',
      category_id: bookData.category_id || '',
      status: bookData.status === 1 || bookData.status === true, // Convert to boolean
      version: bookData.version || '1.0.0',
      downloads: bookData.downloads || 0,
      userview: bookData.userview || 0,
      image_url: bookData.image_url || '',
      file_url: bookData.file_url || '',
      download_url: bookData.download_url || '',
      category: bookData.category || null,
      created_at: bookData.created_at || '',
      updated_at: bookData.updated_at || ''
    });

    showEditModal();
    CloseModal();
  } catch (error) {
    console.error('View book error:', error);
    MessageModal("error", "Error", error.response?.data?.message || error.message || 'Failed to load book');
  }
}

// Toggle status
async function toggleStatus(id) {
  const result = await Swal.fire({
    title: 'Toggle Status',
    text: 'Are you sure you want to toggle this book\'s status?',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes',
    cancelButtonText: 'Cancel'
  });

  if (result.isConfirmed) {
    try {
      LoadingModal();
      const response = await apiTogglePDFBookStatus(id);
      if (response.data?.success) {
        MessageModal("success", "Success", response.data?.message || 'Status updated');
        await loadBooks();
      } else {
        throw new Error(response.data?.message || 'Failed to update status');
      }
    } catch (error) {
      console.error('Toggle status error:', error);
      MessageModal("error", "Error", error.response?.data?.message || error.message || 'Failed to update status');
    }
  }
}

// Fixed: Download book
 function downloadBook(id) {
    const response =  apiDownloadPDFBookID(id);
    if (!response.data) {
      throw new Error('No data received');
    }
    else{
    MessageModal('success', 'Success', 'Book downloaded successfully');
    }
}

// Remove book
async function removeBook(id) {
  const result = await Swal.fire({
    title: 'Delete Book',
    text: 'Are you sure you want to delete this book? This action cannot be undone.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'Cancel'
  });

  if (result.isConfirmed) {
    try {
      LoadingModal();
      const response = await apiDeletePDFBook(id);
      if (response.data?.success) {
        MessageModal("success", "Success", response.data?.message || 'Book deleted');
        await loadBooks();
      } else {
        throw new Error(response.data?.message || 'Failed to delete book');
      }
    } catch (error) {
      console.error('Delete error:', error);
      MessageModal("error", "Error", error.response?.data?.message || error.message || 'Failed to delete book');
    }
  }
}

// Handle image upload with validation
function handleImageUpload(event) {
  const file = event.target.files[0];
  if (file) {
    // Validate file size (2MB)
    if (file.size > 2 * 1024 * 1024) {
      MessageModal('error', 'Error', 'Image size must be less than 2MB');
      event.target.value = '';
      return;
    }

    // Validate file type
    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
    if (!allowedTypes.includes(file.type)) {
      MessageModal('error', 'Error', 'Only JPEG, PNG, JPG, and GIF images are allowed');
      event.target.value = '';
      return;
    }

    imageFile.value = file;
    imageFileName.value = file.name;

    // Create preview
    const reader = new FileReader();
    reader.onload = (e) => imagePreview.value = e.target.result;
    reader.readAsDataURL(file);
  }
}

// Handle file upload with validation
function handleFileUpload(event) {
  const file = event.target.files[0];
  if (file) {
    // Validate file size (10MB)
    if (file.size > 10 * 1024 * 1024) {
      MessageModal('error', 'Error', 'PDF size must be less than 10MB');
      event.target.value = '';
      return;
    }

    // Validate file type
    if (file.type !== 'application/pdf') {
      MessageModal('error', 'Error', 'Only PDF files are allowed');
      event.target.value = '';
      return;
    }

    fileFile.value = file;
    fileFileName.value = file.name;
    bookObjectErr.file = ''; // Clear any previous error
  }
}

// Apply filters
function applyFilters() {
  pagination.value.current_page = 1;
  loadBooks();
}

// Reset filters
function resetFilters() {
  filters.category_id = '';
  filters.status = '';
  filters.search = '';
  applyFilters();
}

// Change page
function changePage(page) {
  if (page < 1 || page > pagination.value.last_page) return;
  pagination.value.current_page = page;
  loadBooks();
}

// Show modal for create
function showBookModal() {
  resetData(); // Reset to create mode (id = null)
  if (bookModal.value) {
    $(bookModal.value).modal("show");
  }
}

// Show modal for edit
function showEditModal() {
  if (bookModal.value) {
    $(bookModal.value).modal("show");
  }
}

// Hide modal
function hideBookModal() {
  if (bookModal.value) {
    $(bookModal.value).modal("hide");
  }
}

// Reset data
function resetData() {
  // Create a fresh copy of defaultBookObject
  const freshObject = JSON.parse(JSON.stringify(defaultBookObject));

  // Reset bookObject
  Object.keys(bookObject).forEach(key => {
    bookObject[key] = freshObject[key];
  });

  // Reset errors
  Object.keys(bookObjectErr).forEach(key => {
    bookObjectErr[key] = '';
  });

  // Reset file refs
  imageFile.value = null;
  fileFile.value = null;
  imageFileName.value = '';
  fileFileName.value = '';
  imagePreview.value = null;

  // Reset file inputs
  if (imageInput.value) {
    imageInput.value.value = '';
  }
  if (fileInput.value) {
    fileInput.value.value = '';
  }
}

// Get serial number with pagination
function getSerialNumber(index) {
  return ((pagination.value.current_page - 1) * pagination.value.per_page) + index + 1;
}

// Format date
function formatDate(dateString, format = 'full') {
  if (!dateString) return 'N/A';
  try {
    const date = new Date(dateString);
    if (format === 'short') {
      return date.toLocaleDateString('km-KH', { month: 'short', day: 'numeric', year: 'numeric' });
    }
    return date.toLocaleDateString('km-KH', { year: 'numeric', month: 'short', day: 'numeric' });
  } catch (e) {
    return 'Invalid Date';
  }
}

// Truncate text
function truncateText(text, length) {
  if (!text) return '';
  return text.length > length ? text.substring(0, length) + '...' : text;
}
</script>

<style scoped>
.text-gradient {
  background: linear-gradient(45deg, #4e73df, #1cc88a);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.small-box {
  border-radius: 0.5rem;
  transition: transform 0.3s;
}

.small-box:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.required-field::after {
  content: ' *';
  color: red;
}

.image-upload-wrapper, .file-upload-wrapper {
  border: 2px dashed #dee2e6;
  border-radius: 0.5rem;
  padding: 1rem;
  transition: border-color 0.3s;
}

.image-upload-wrapper:hover, .file-upload-wrapper:hover {
  border-color: #4e73df;
}

.stat-box {
  padding: 0.5rem;
  border-radius: 0.5rem;
  background: white;
  box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

.stat-value {
  display: block;
  font-size: 1.5rem;
  font-weight: bold;
  color: #4e73df;
}

.stat-label {
  font-size: 0.875rem;
  color: #858796;
}

.empty-state {
  text-align: center;
  padding: 3rem;
  color: #b7b9cc;
}

.table td, .table th {
  vertical-align: middle;
}

.btn-group .btn {
  margin: 0 2px;
  border-radius: 0.25rem !important;
}

.custom-file-label::after {
  content: "Browse";
}

.bg-gradient-primary {
  background: linear-gradient(45deg, #4e73df, #224abe);
}
</style>
