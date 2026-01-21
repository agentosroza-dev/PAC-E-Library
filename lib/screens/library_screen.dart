import 'package:flutter/material.dart';
import 'package:cached_network_image/cached_network_image.dart';

/// =======================================================
/// LIBRARY SCREEN
/// =======================================================
class LibraryScreen extends StatefulWidget {
  const LibraryScreen({super.key});

  @override
  State<LibraryScreen> createState() => _LibraryScreenState();
}

class _LibraryScreenState extends State<LibraryScreen> {
  bool isGrid = true;

  // pagination
  static const int pageSize = 6;
  int page = 1;

  bool isRefreshing = false;
  bool isLoadingMore = false;
  bool isFirstLoading = true;

  final ScrollController _scrollCtrl = ScrollController();

  // filters
  String selectedCategory = "All";
  late final List<String> allCategories;

  // ===============================
  // DATA
  // ===============================
  final List<Book> books = [
    Book(
      id: "1",
      title: "Clean Code",
      author: "Robert C. Martin",
      publisher: "Prentice Hall",
      rating: 4.7,
      categories: ["Technology", "Programming"],
      tags: ["Best Practices", "Code Quality"],
      description: "A handbook of agile software craftsmanship.",
      coverUrl: "https://covers.openlibrary.org/b/isbn/9780132350884-L.jpg",
      reviews: [BookReview(user: "Dara", rating: 5, comment: "Excellent")],
    ),
    Book(
      id: "2",
      title: "Clean Architecture",
      author: "Robert C. Martin",
      publisher: "Pearson",
      rating: 4.6,
      categories: ["Technology", "Architecture"],
      tags: ["Design", "SOLID"],
      description: "Software architecture principles.",
      coverUrl: "https://covers.openlibrary.org/b/isbn/9780134494166-L.jpg",
      reviews: [BookReview(user: "Rath", rating: 5, comment: "Very clear")],
    ),
    Book(
      id: "3",
      title: "Refactoring",
      author: "Martin Fowler",
      publisher: "Addison-Wesley",
      rating: 4.5,
      categories: ["Technology", "Programming"],
      tags: ["Refactor"],
      description: "Improving existing code.",
      coverUrl: "https://covers.openlibrary.org/b/isbn/9780201485677-L.jpg",
      reviews: [],
    ),
    Book(
      id: "4",
      title: "Design Patterns",
      author: "Erich Gamma",
      publisher: "Addison-Wesley",
      rating: 4.4,
      categories: ["Technology", "Architecture"],
      tags: ["Patterns"],
      description: "Classic GoF patterns.",
      coverUrl: "https://covers.openlibrary.org/b/isbn/9780201633610-L.jpg",
      reviews: [],
    ),
    Book(
      id: "5",
      title: "The Pragmatic Programmer",
      author: "Andrew Hunt",
      publisher: "Addison-Wesley",
      rating: 4.8,
      categories: ["Technology", "Programming"],
      tags: ["Career"],
      description: "Timeless programming advice.",
      coverUrl: "https://covers.openlibrary.org/b/isbn/9780201616224-L.jpg",
      reviews: [],
    ),
    Book(
      id: "6",
      title: "Effective Java",
      author: "Joshua Bloch",
      publisher: "Addison-Wesley",
      rating: 4.7,
      categories: ["Technology", "Programming"],
      tags: ["Java"],
      description: "Best practices for Java.",
      coverUrl: "https://covers.openlibrary.org/b/isbn/9780134685991-L.jpg",
      reviews: [],
    ),
    Book(
      id: "7",
      title: "The Art of War",
      author: "Sun Tzu",
      publisher: "Oxford",
      rating: 4.4,
      categories: ["History", "Philosophy"],
      tags: ["Strategy"],
      description: "Ancient military strategy.",
      coverUrl: "https://covers.openlibrary.org/b/isbn/9780195014761-L.jpg",
      reviews: [],
    ),
    Book(
      id: "8",
      title: "No Image Demo",
      author: "Unknown",
      publisher: "Unknown",
      rating: 4.0,
      categories: ["Technology"],
      tags: ["Demo"],
      description: "This item has no image url.",
      coverUrl: "",
      reviews: [],
    ),
    Book(
      id: "11",
      title: "Clean Code",
      author: "Robert C. Martin",
      publisher: "Prentice Hall",
      rating: 4.7,
      categories: ["Technology", "Programming"],
      tags: ["Best Practices", "Code Quality"],
      description: "A handbook of agile software craftsmanship.",
      coverUrl: "https://covers.openlibrary.org/b/isbn/9780132350884-L.jpg",
      reviews: [BookReview(user: "Dara", rating: 5, comment: "Excellent")],
    ),
    Book(
      id: "12",
      title: "Clean Architecture",
      author: "Robert C. Martin",
      publisher: "Pearson",
      rating: 4.6,
      categories: ["Technology", "Architecture"],
      tags: ["Design", "SOLID"],
      description: "Software architecture principles.",
      coverUrl: "https://covers.openlibrary.org/b/isbn/9780134494166-L.jpg",
      reviews: [BookReview(user: "Rath", rating: 5, comment: "Very clear")],
    ),
    Book(
      id: "13",
      title: "Refactoring",
      author: "Martin Fowler",
      publisher: "Addison-Wesley",
      rating: 4.5,
      categories: ["Technology", "Programming"],
      tags: ["Refactor"],
      description: "Improving existing code.",
      coverUrl: "https://covers.openlibrary.org/b/isbn/9780201485677-L.jpg",
      reviews: [],
    ),
    Book(
      id: "14",
      title: "Design Patterns",
      author: "Erich Gamma",
      publisher: "Addison-Wesley",
      rating: 4.4,
      categories: ["Technology", "Architecture"],
      tags: ["Patterns"],
      description: "Classic GoF patterns.",
      coverUrl: "https://covers.openlibrary.org/b/isbn/9780201633610-L.jpg",
      reviews: [],
    ),
    Book(
      id: "15",
      title: "The Pragmatic Programmer",
      author: "Andrew Hunt",
      publisher: "Addison-Wesley",
      rating: 4.8,
      categories: ["Technology", "Programming"],
      tags: ["Career"],
      description: "Timeless programming advice.",
      coverUrl: "https://covers.openlibrary.org/b/isbn/9780201616224-L.jpg",
      reviews: [],
    ),
    Book(
      id: "16",
      title: "Effective Java",
      author: "Joshua Bloch",
      publisher: "Addison-Wesley",
      rating: 4.7,
      categories: ["Technology", "Programming"],
      tags: ["Java"],
      description: "Best practices for Java.",
      coverUrl: "https://covers.openlibrary.org/b/isbn/9780134685991-L.jpg",
      reviews: [],
    ),
    Book(
      id: "17",
      title: "The Art of War",
      author: "Sun Tzu",
      publisher: "Oxford",
      rating: 4.4,
      categories: ["History", "Philosophy"],
      tags: ["Strategy"],
      description: "Ancient military strategy.",
      coverUrl: "https://covers.openlibrary.org/b/isbn/9780195014761-L.jpg",
      reviews: [],
    ),
    Book(
      id: "18",
      title: "No Image Demo",
      author: "Unknown",
      publisher: "Unknown",
      rating: 4.0,
      categories: ["Technology"],
      tags: ["Demo"],
      description: "This item has no image url.",
      coverUrl: "",
      reviews: [],
    ),
  ];

  List<Book> get _filteredAll {
    if (selectedCategory == "All") return books;
    return books.where((b) => b.categories.contains(selectedCategory)).toList();
  }

  List<Book> get visibleBooks {
    final full = _filteredAll;
    final take = (page * pageSize).clamp(0, full.length);
    return full.take(take).toList();
  }

  bool get hasMore => visibleBooks.length < _filteredAll.length;

  @override
  void initState() {
    super.initState();

    // build categories
    final set = <String>{};
    for (final b in books) {
      set.addAll(b.categories);
    }
    allCategories = ["All", ...set.toList()..sort()];

    Future.delayed(const Duration(milliseconds: 500), () {
      if (!mounted) return;
      setState(() => isFirstLoading = false);
    });

    _scrollCtrl.addListener(() {
      if (_scrollCtrl.position.pixels >= _scrollCtrl.position.maxScrollExtent - 250) {
        _loadMore();
      }
    });
  }

  @override
  void dispose() {
    _scrollCtrl.dispose();
    super.dispose();
  }

  Future<void> _refresh() async {
    if (isRefreshing) return;
    setState(() => isRefreshing = true);

    await Future.delayed(const Duration(milliseconds: 600));
    books.shuffle();

    if (!mounted) return;
    setState(() {
      page = 1;
      isRefreshing = false;
    });
  }

  Future<void> _loadMore() async {
    if (!hasMore || isLoadingMore || isRefreshing || isFirstLoading) return;
    setState(() => isLoadingMore = true);

    await Future.delayed(const Duration(milliseconds: 500));

    if (!mounted) return;
    setState(() {
      page += 1; // each page adds +6 items
      isLoadingMore = false;
    });
  }

  void _setCategory(String c) {
    setState(() {
      selectedCategory = c;
      page = 1;
    });
  }

  void _openDetails(Book book) {
    Navigator.push(
      context,
      MaterialPageRoute(builder: (_) => BookDetailsPage(book: book, allBooks: books)),
    );
  }

  @override
  Widget build(BuildContext context) {
    final cs = Theme.of(context).colorScheme;

    return Scaffold(
      body: RefreshIndicator(
        onRefresh: _refresh,
        color: cs.primary,
        child: CustomScrollView(
          controller: _scrollCtrl,
          physics: const AlwaysScrollableScrollPhysics(),
          slivers: [
            SliverAppBar(
              floating: true,
              snap: true,
              title: const Text("Library", style: TextStyle(fontWeight: FontWeight.w800)),
              actions: [
                IconButton(
                  tooltip: isGrid ? "List view" : "Grid view",
                  icon: Icon(isGrid ? Icons.view_list : Icons.grid_view),
                  onPressed: () => setState(() => isGrid = !isGrid),
                ),
                IconButton(
                  tooltip: "Refresh",
                  icon: const Icon(Icons.refresh),
                  onPressed: () => _refresh(), // ✅ wrap async
                ),
              ],
            ),

            // Categories (chips)
            SliverToBoxAdapter(
              child: Padding(
                padding: const EdgeInsets.fromLTRB(16, 12, 16, 12),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    SizedBox(
                      height: 42,
                      child: ListView.separated(
                        scrollDirection: Axis.horizontal,
                        itemCount: allCategories.length,
                        separatorBuilder: (_, __) => const SizedBox(width: 10),
                        itemBuilder: (_, i) {
                          final c = allCategories[i];
                          return ChoiceChip(
                            label: Text(c),
                            selected: c == selectedCategory,
                            onSelected: (_) => _setCategory(c),
                            selectedColor: cs.primary.withOpacity(0.15),
                            side: BorderSide(color: cs.primary.withOpacity(0.25)),
                            labelStyle: TextStyle(
                              fontWeight: FontWeight.w800,
                              color: (c == selectedCategory) ? cs.primary : cs.onSurface,
                            ),
                          );
                        },
                      ),
                    ),
                    const SizedBox(height: 10),
                    Text(
                      "Showing ${visibleBooks.length} / ${_filteredAll.length}  (+$pageSize auto)",
                      style: TextStyle(color: cs.onSurface.withOpacity(0.65), fontWeight: FontWeight.w700),
                    ),
                  ],
                ),
              ),
            ),

            // CONTENT
            if (isFirstLoading)
              const SliverToBoxAdapter(child: _LibraryShimmer())
            else if (_filteredAll.isEmpty)
              SliverFillRemaining(
                hasScrollBody: false,
                child: Center(
                  child: Text("No books found.", style: TextStyle(color: cs.onSurface.withOpacity(0.65))),
                ),
              )
            else if (isGrid)
                SliverPadding(
                  padding: const EdgeInsets.fromLTRB(16, 0, 16, 16),
                  sliver: SliverGrid(
                    gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
                      crossAxisCount: 2,
                      mainAxisSpacing: 12,
                      crossAxisSpacing: 12,
                      childAspectRatio: 0.70,
                    ),
                    delegate: SliverChildBuilderDelegate(
                          (context, i) {
                        if (i >= visibleBooks.length) {
                          return _BottomLoader(isLoading: isLoadingMore, hasMore: hasMore);
                        }
                        final b = visibleBooks[i];
                        return InkWell(
                          borderRadius: BorderRadius.circular(18),
                          onTap: () => _openDetails(b),
                          child: _BookGridCard(book: b),
                        );
                      },
                      childCount: visibleBooks.length + (hasMore ? 1 : 0),
                    ),
                  ),
                )
              else
                SliverPadding(
                  padding: const EdgeInsets.fromLTRB(16, 0, 16, 16),
                  sliver: SliverList(
                    delegate: SliverChildBuilderDelegate(
                          (context, i) {
                        if (i >= visibleBooks.length) {
                          return Padding(
                            padding: const EdgeInsets.only(top: 12),
                            child: _BottomLoader(isLoading: isLoadingMore, hasMore: hasMore),
                          );
                        }
                        final b = visibleBooks[i];
                        return Padding(
                          padding: const EdgeInsets.only(bottom: 12),
                          child: InkWell(
                            borderRadius: BorderRadius.circular(18),
                            onTap: () => _openDetails(b),
                            child: _BookListTile(book: b),
                          ),
                        );
                      },
                      childCount: visibleBooks.length + (hasMore ? 1 : 0),
                    ),
                  ),
                ),
          ],
        ),
      ),
    );
  }
}

/// =======================================================
/// BOOK DETAILS PAGE (FULL + FIXED)
/// =======================================================
class BookDetailsPage extends StatefulWidget {
  final Book book;
  final List<Book> allBooks;

  const BookDetailsPage({super.key, required this.book, required this.allBooks});

  @override
  State<BookDetailsPage> createState() => _BookDetailsPageState();
}

class _BookDetailsPageState extends State<BookDetailsPage> {
  late bool isFavorite;
  late final List<BookReview> reviews;

  @override
  void initState() {
    super.initState();
    isFavorite = widget.book.isFavorite;
    reviews = List<BookReview>.from(widget.book.reviews);
  }

  @override
  Widget build(BuildContext context) {
    final cs = Theme.of(context).colorScheme;

    final similar = widget.allBooks
        .where((b) =>
    b.id != widget.book.id &&
        b.categories.any((c) => widget.book.categories.contains(c)))
        .toList();

    return Scaffold(
      appBar: AppBar(
        title: const Text("Book Details", style: TextStyle(fontWeight: FontWeight.w800)),
        actions: [
          IconButton(
            tooltip: isFavorite ? "Remove favorite" : "Add to favorites",
            onPressed: () => setState(() => isFavorite = !isFavorite),
            icon: Icon(isFavorite ? Icons.favorite_rounded : Icons.favorite_border_rounded),
            color: isFavorite ? Colors.red : null,
          ),
        ],
      ),
      body: ListView(
        padding: const EdgeInsets.fromLTRB(16, 12, 16, 16),
        children: [
          Row(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              ClipRRect(
                borderRadius: BorderRadius.circular(18),
                child: CachedNetImage(url: widget.book.coverUrl, width: 120, height: 170),
              ),
              const SizedBox(width: 14),
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(widget.book.title, style: const TextStyle(fontSize: 18, fontWeight: FontWeight.w900)),
                    const SizedBox(height: 6),
                    Text(widget.book.author,
                        style: TextStyle(color: cs.onSurface.withOpacity(0.65), fontWeight: FontWeight.w700)),
                    const SizedBox(height: 6),
                    Text("Publisher: ${widget.book.publisher}",
                        style: TextStyle(color: cs.onSurface.withOpacity(0.60))),
                    const SizedBox(height: 10),
                    Row(
                      children: [
                        const Icon(Icons.star_rounded, color: Colors.amber, size: 18),
                        const SizedBox(width: 4),
                        Text(widget.book.rating.toStringAsFixed(1), style: const TextStyle(fontWeight: FontWeight.w800)),
                        const SizedBox(width: 10),
                        Text("(${reviews.length} reviews)",
                            style: TextStyle(color: cs.onSurface.withOpacity(0.60))),
                      ],
                    ),
                    const SizedBox(height: 12),
                    Row(
                      children: [
                        Expanded(
                          child: ElevatedButton.icon(
                            onPressed: () {
                              Navigator.push(context,
                                  MaterialPageRoute(builder: (_) => BookPreviewPage(book: widget.book)));
                            },
                            icon: const Icon(Icons.play_arrow_rounded),
                            label: const Text("Preview"),
                            style: ElevatedButton.styleFrom(
                              backgroundColor: cs.primary,
                              foregroundColor: cs.onPrimary,
                              shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(14)),
                              padding: const EdgeInsets.symmetric(vertical: 12),
                            ),
                          ),
                        ),
                        const SizedBox(width: 10),
                        OutlinedButton.icon(
                          onPressed: () => setState(() => isFavorite = !isFavorite),
                          icon: Icon(isFavorite ? Icons.favorite_rounded : Icons.favorite_border_rounded, color: cs.primary),
                          label: Text(isFavorite ? "Saved" : "Favorite"),
                          style: OutlinedButton.styleFrom(
                            shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(14)),
                            side: BorderSide(color: cs.primary.withOpacity(0.35)),
                            padding: const EdgeInsets.symmetric(vertical: 12, horizontal: 12),
                          ),
                        ),
                      ],
                    ),
                  ],
                ),
              ),
            ],
          ),

          const SizedBox(height: 18),
          _InfoChips(title: "Categories", items: widget.book.categories),
          const SizedBox(height: 10),
          _InfoChips(title: "Tags", items: widget.book.tags),

          const SizedBox(height: 18),
          const Text("Description", style: TextStyle(fontSize: 16, fontWeight: FontWeight.w900)),
          const SizedBox(height: 8),
          Text(widget.book.description, style: TextStyle(color: cs.onSurface.withOpacity(0.75), height: 1.35)),

          const SizedBox(height: 18),
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              const Text("Ratings & Reviews", style: TextStyle(fontSize: 16, fontWeight: FontWeight.w900)),
              TextButton(
                onPressed: () => _showAddReview(context),
                child: Text("Write review", style: TextStyle(color: cs.primary, fontWeight: FontWeight.w800)),
              ),
            ],
          ),
          const SizedBox(height: 8),
          if (reviews.isEmpty)
            Text("No reviews yet.", style: TextStyle(color: cs.onSurface.withOpacity(0.65)))
          else
            ...reviews.map((r) => _ReviewTile(review: r)),

          const SizedBox(height: 18),
          const Text("Similar titles", style: TextStyle(fontSize: 16, fontWeight: FontWeight.w900)),
          const SizedBox(height: 10),
          if (similar.isEmpty)
            Text("No recommendations found.", style: TextStyle(color: cs.onSurface.withOpacity(0.65)))
          else
            SizedBox(
              height: 210,
              child: ListView.separated(
                scrollDirection: Axis.horizontal,
                itemCount: similar.length,
                separatorBuilder: (_, __) => const SizedBox(width: 12),
                itemBuilder: (_, i) => SizedBox(
                  width: 140,
                  child: _MiniBookCard(
                    book: similar[i],
                    onTap: () {
                      Navigator.pushReplacement(
                        context,
                        MaterialPageRoute(
                          builder: (_) => BookDetailsPage(book: similar[i], allBooks: widget.allBooks),
                        ),
                      );
                    },
                  ),
                ),
              ),
            ),
        ],
      ),
    );
  }

  void _showAddReview(BuildContext context) {
    final cs = Theme.of(context).colorScheme;
    final nameCtrl = TextEditingController();
    final commentCtrl = TextEditingController();
    double rating = 5;

    showModalBottomSheet(
      context: context,
      isScrollControlled: true,
      showDragHandle: true,
      builder: (_) {
        return Padding(
          padding: EdgeInsets.only(
            left: 16,
            right: 16,
            top: 12,
            bottom: MediaQuery.of(context).viewInsets.bottom + 16,
          ),
          child: Column(
            mainAxisSize: MainAxisSize.min,
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              const Text("Write a review", style: TextStyle(fontSize: 16, fontWeight: FontWeight.w900)),
              const SizedBox(height: 12),
              TextField(
                controller: nameCtrl,
                decoration: const InputDecoration(labelText: "Your name", border: OutlineInputBorder()),
              ),
              const SizedBox(height: 10),
              TextField(
                controller: commentCtrl,
                minLines: 3,
                maxLines: 5,
                decoration: const InputDecoration(labelText: "Comment", border: OutlineInputBorder()),
              ),
              const SizedBox(height: 10),
              Row(
                children: [
                  const Text("Rating:", style: TextStyle(fontWeight: FontWeight.w800)),
                  const SizedBox(width: 10),
                  Expanded(
                    child: Slider(
                      value: rating,
                      min: 1,
                      max: 5,
                      divisions: 8,
                      label: rating.toStringAsFixed(1),
                      onChanged: (v) => setState(() => rating = v),
                    ),
                  ),
                ],
              ),
              const SizedBox(height: 10),
              SizedBox(
                width: double.infinity,
                child: ElevatedButton(
                  onPressed: () {
                    final name = nameCtrl.text.trim().isEmpty ? "User" : nameCtrl.text.trim();
                    final comment = commentCtrl.text.trim().isEmpty ? "Great book!" : commentCtrl.text.trim();
                    setState(() {
                      reviews.insert(0, BookReview(user: name, rating: rating, comment: comment));
                    });
                    Navigator.pop(context);
                    ScaffoldMessenger.of(context).showSnackBar(const SnackBar(content: Text("Review added")));
                  },
                  style: ElevatedButton.styleFrom(
                    backgroundColor: cs.primary,
                    foregroundColor: cs.onPrimary,
                    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(14)),
                    padding: const EdgeInsets.symmetric(vertical: 12),
                  ),
                  child: const Text("Submit"),
                ),
              ),
            ],
          ),
        );
      },
    );
  }
}

/// =======================================================
/// PREVIEW PAGE
/// =======================================================
class BookPreviewPage extends StatelessWidget {
  final Book book;
  const BookPreviewPage({super.key, required this.book});

  @override
  Widget build(BuildContext context) {
    final cs = Theme.of(context).colorScheme;

    return Scaffold(
      appBar: AppBar(
        title: const Text("Preview", style: TextStyle(fontWeight: FontWeight.w800)),
      ),
      body: Column(
        children: [
          // Header
          Container(
            padding: const EdgeInsets.all(16),
            decoration: BoxDecoration(
              border: Border(bottom: BorderSide(color: cs.outline.withOpacity(0.15))),
            ),
            child: Row(
              children: [
                CachedNetImage(url: book.coverUrl, width: 60, height: 80),
                const SizedBox(width: 12),
                Expanded(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(book.title, style: const TextStyle(fontWeight: FontWeight.w900)),
                      const SizedBox(height: 4),
                      Text(book.author, style: TextStyle(color: cs.onSurface.withOpacity(0.65))),
                    ],
                  ),
                ),
              ],
            ),
          ),

          // Preview content
          Expanded(
            child: ListView(
              padding: const EdgeInsets.all(16),
              children: const [
                Text(
                  "PDF / EPUB preview placeholder\n\n"
                      "You can integrate:\n"
                      "- syncfusion_flutter_pdfviewer (PDF)\n"
                      "- epub_view (EPUB)\n\n"
                      "Preview limit reached.",
                  style: TextStyle(height: 1.5),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}


/// =======================================================
/// UI WIDGETS
/// =======================================================
class _BottomLoader extends StatelessWidget {
  final bool isLoading;
  final bool hasMore;
  const _BottomLoader({required this.isLoading, required this.hasMore});

  @override
  Widget build(BuildContext context) {
    final cs = Theme.of(context).colorScheme;

    return Container(
      margin: const EdgeInsets.only(top: 4),
      padding: const EdgeInsets.symmetric(vertical: 14),
      decoration: BoxDecoration(
        color: Theme.of(context).cardColor,
        borderRadius: BorderRadius.circular(14),
        border: Border.all(color: cs.primary.withOpacity(0.10)),
      ),
      child: Center(
        child: hasMore
            ? (isLoading
            ? Row(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            SizedBox(
              width: 16,
              height: 16,
              child: CircularProgressIndicator(strokeWidth: 2, color: cs.primary),
            ),
            const SizedBox(width: 10),
            const Text("Loading more...", style: TextStyle(fontWeight: FontWeight.w800)),
          ],
        )
            : Text("Scroll to load more", style: TextStyle(color: Theme.of(context).hintColor, fontWeight: FontWeight.w800)))
            : Text("No more results", style: TextStyle(color: Theme.of(context).hintColor, fontWeight: FontWeight.w800)),
      ),
    );
  }
}

class CachedNetImage extends StatelessWidget {
  final String url;
  final double? width;
  final double? height;
  final BoxFit fit;

  const CachedNetImage({
    super.key,
    required this.url,
    this.width,
    this.height,
    this.fit = BoxFit.cover,
  });

  @override
  Widget build(BuildContext context) {
    final cs = Theme.of(context).colorScheme;
    final safeUrl = url.trim();

    if (safeUrl.isEmpty) return _noImage(context, cs);

    return CachedNetworkImage(
      imageUrl: safeUrl,
      width: width,
      height: height,
      fit: fit,
      placeholder: (_, __) => Container(
        width: width,
        height: height,
        alignment: Alignment.center,
        color: cs.primary.withOpacity(0.10),
        child: SizedBox(
          width: 18,
          height: 18,
          child: CircularProgressIndicator(strokeWidth: 2, color: cs.primary),
        ),
      ),
      errorWidget: (_, __, ___) => _noImage(context, cs),
    );
  }

  Widget _noImage(BuildContext context, ColorScheme cs) {
    return Container(
      width: width,
      height: height,
      color: cs.primary.withOpacity(0.10),
      alignment: Alignment.center,
      padding: const EdgeInsets.all(10),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Icon(Icons.image_not_supported_rounded, color: cs.primary, size: 26),
          const SizedBox(height: 6),
          Text(
            "Image\nnot available",
            textAlign: TextAlign.center,
            style: TextStyle(
              fontWeight: FontWeight.w800,
              fontSize: 11,
              height: 1.1,
              color: cs.primary,
            ),
          ),
        ],
      ),
    );
  }
}

class _BookGridCard extends StatelessWidget {
  final Book book;
  const _BookGridCard({required this.book});

  @override
  Widget build(BuildContext context) {
    final cs = Theme.of(context).colorScheme;

    return Container(
      decoration: BoxDecoration(
        color: cs.surface,
        borderRadius: BorderRadius.circular(18),
        border: Border.all(color: cs.outline.withOpacity(0.10)),
        boxShadow: [
          BoxShadow(blurRadius: 14, color: Colors.black.withOpacity(0.05), offset: const Offset(0, 10)),
        ],
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Expanded(
            child: ClipRRect(
              borderRadius: const BorderRadius.vertical(top: Radius.circular(18)),
              child: CachedNetImage(url: book.coverUrl, width: double.infinity),
            ),
          ),
          Padding(
            padding: const EdgeInsets.fromLTRB(12, 10, 12, 10),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(book.title, maxLines: 1, overflow: TextOverflow.ellipsis, style: const TextStyle(fontWeight: FontWeight.w900)),
                const SizedBox(height: 4),
                Text(book.author, maxLines: 1, overflow: TextOverflow.ellipsis, style: TextStyle(color: cs.onSurface.withOpacity(0.65))),
                const SizedBox(height: 8),
                Row(
                  children: [
                    const Icon(Icons.star_rounded, size: 18, color: Colors.amber),
                    const SizedBox(width: 4),
                    Text(book.rating.toStringAsFixed(1), style: const TextStyle(fontWeight: FontWeight.w900)),
                  ],
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}

class _BookListTile extends StatelessWidget {
  final Book book;
  const _BookListTile({required this.book});

  @override
  Widget build(BuildContext context) {
    final cs = Theme.of(context).colorScheme;

    return Container(
      padding: const EdgeInsets.all(12),
      decoration: BoxDecoration(
        color: cs.surface,
        borderRadius: BorderRadius.circular(18),
        border: Border.all(color: cs.outline.withOpacity(0.10)),
        boxShadow: [
          BoxShadow(blurRadius: 14, color: Colors.black.withOpacity(0.05), offset: const Offset(0, 10)),
        ],
      ),
      child: Row(
        children: [
          ClipRRect(
            borderRadius: BorderRadius.circular(12),
            child: CachedNetImage(url: book.coverUrl, width: 60, height: 84),
          ),
          const SizedBox(width: 12),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(book.title, maxLines: 1, overflow: TextOverflow.ellipsis, style: const TextStyle(fontWeight: FontWeight.w900)),
                const SizedBox(height: 4),
                Text(book.author, maxLines: 1, overflow: TextOverflow.ellipsis, style: TextStyle(color: cs.onSurface.withOpacity(0.65))),
                const SizedBox(height: 8),
                Row(
                  children: [
                    const Icon(Icons.star_rounded, size: 18, color: Colors.amber),
                    const SizedBox(width: 4),
                    Text(book.rating.toStringAsFixed(1), style: const TextStyle(fontWeight: FontWeight.w900)),
                    const Spacer(),
                    Icon(Icons.chevron_right_rounded, color: cs.primary),
                  ],
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}

class _MiniBookCard extends StatelessWidget {
  final Book book;
  final VoidCallback onTap;
  const _MiniBookCard({required this.book, required this.onTap});

  @override
  Widget build(BuildContext context) {
    final cs = Theme.of(context).colorScheme;

    return InkWell(
      borderRadius: BorderRadius.circular(18),
      onTap: onTap,
      child: Container(
        decoration: BoxDecoration(
          color: cs.surface,
          borderRadius: BorderRadius.circular(18),
          border: Border.all(color: cs.outline.withOpacity(0.10)),
        ),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Expanded(
              child: ClipRRect(
                borderRadius: const BorderRadius.vertical(top: Radius.circular(18)),
                child: CachedNetImage(url: book.coverUrl, width: double.infinity),
              ),
            ),
            Padding(
              padding: const EdgeInsets.all(10),
              child: Text(
                book.title,
                maxLines: 2,
                overflow: TextOverflow.ellipsis,
                style: const TextStyle(fontWeight: FontWeight.w900),
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class _InfoChips extends StatelessWidget {
  final String title;
  final List<String> items;

  const _InfoChips({required this.title, required this.items});

  @override
  Widget build(BuildContext context) {
    final cs = Theme.of(context).colorScheme;

    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(title, style: const TextStyle(fontWeight: FontWeight.w900)),
        const SizedBox(height: 8),
        Wrap(
          spacing: 10,
          runSpacing: 10,
          children: items
              .map((t) => Container(
            padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 8),
            decoration: BoxDecoration(
              color: cs.primary.withOpacity(0.12),
              borderRadius: BorderRadius.circular(16),
              border: Border.all(color: cs.primary.withOpacity(0.18)),
            ),
            child: Text(t, style: TextStyle(color: cs.primary, fontWeight: FontWeight.w700)),
          ))
              .toList(),
        ),
      ],
    );
  }
}

class _ReviewTile extends StatelessWidget {
  final BookReview review;
  const _ReviewTile({required this.review});

  @override
  Widget build(BuildContext context) {
    final cs = Theme.of(context).colorScheme;

    return Container(
      margin: const EdgeInsets.only(bottom: 10),
      padding: const EdgeInsets.all(12),
      decoration: BoxDecoration(
        color: cs.surface,
        borderRadius: BorderRadius.circular(16),
        border: Border.all(color: cs.outline.withOpacity(0.10)),
      ),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          CircleAvatar(
            backgroundColor: cs.primary.withOpacity(0.12),
            child: Text(
              review.user.isNotEmpty ? review.user[0].toUpperCase() : "U",
              style: TextStyle(fontWeight: FontWeight.w900, color: cs.primary),
            ),
          ),
          const SizedBox(width: 10),
          Expanded(
            child: Column(crossAxisAlignment: CrossAxisAlignment.start, children: [
              Row(children: [
                Text(review.user, style: const TextStyle(fontWeight: FontWeight.w900)),
                const SizedBox(width: 10),
                const Icon(Icons.star_rounded, size: 16, color: Colors.amber),
                const SizedBox(width: 4),
                Text(review.rating.toStringAsFixed(1), style: const TextStyle(fontWeight: FontWeight.w800)),
              ]),
              const SizedBox(height: 6),
              Text(review.comment, style: TextStyle(color: cs.onSurface.withOpacity(0.70))),
            ]),
          ),
        ],
      ),
    );
  }
}

class _LibraryShimmer extends StatelessWidget {
  const _LibraryShimmer();

  @override
  Widget build(BuildContext context) {
    return const Padding(
      padding: EdgeInsets.all(16),
      child: Center(child: CircularProgressIndicator()),
    );
  }
}

/// =======================================================
/// MODELS
/// =======================================================
class Book {
  final String id;
  final String title;
  final String author;
  final String publisher;
  final double rating;
  final List<String> categories;
  final List<String> tags;
  final String description;
  final String coverUrl;
  final List<BookReview> reviews;

  // ✅ add isFavorite to fix widget.book.isFavorite usage
  final bool isFavorite;

  Book({
    required this.id,
    required this.title,
    required this.author,
    required this.publisher,
    required this.rating,
    required this.categories,
    required this.tags,
    required this.description,
    required this.coverUrl,
    required this.reviews,
    this.isFavorite = false,
  });
}

class BookReview {
  final String user;
  final double rating;
  final String comment;

  BookReview({required this.user, required this.rating, required this.comment});
}
