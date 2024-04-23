import { useEffect, useState } from "react";
import BookList from "./book-list";
import Pagination from "./pagination";
import HttpService from "../services/http";
import { BookStatusType } from "../COMMON";
import SearchBar from "./search-bar";


const Home = () => {
    const httpService = new HttpService();
    const [books, setBooks] = useState([
        {
            "id": 1,
            "title": "Oedipus at Colonus",
            "author": "Jebb, Richard Claverhouse, Sir, 1841-1905",
            "date": "1930",
            "status": "borrowed"
        },
        {
            "id": 2,
            "title": "The Iliad",
            "author": "Bryant, William Cullen, 1794-1878",
            "date": "c1870",
            "status": "free"
        },
        {
            "id": 3,
            "title": "The Prometheus",
            "author": "Buckley, Theodore Alois, 1825-1856",
            "date": "1899",
            "status": "borrowed"
        },
        {
            "id": 4,
            "title": "Parmenides",
            "author": "Maguire, Thomas, 1831-1889",
            "date": "1882",
            "status": "free"
        },
        {
            "id": 5,
            "title": "Oedipus at Colonus",
            "author": "Jebb, Richard Claverhouse, Sir, 1841-1905",
            "date": "1930",
            "status": "free"
        },
        {
            "id": 6,
            "title": "The Iliad",
            "author": "Bryant, William Cullen, 1794-1878",
            "date": "c1870",
            "status": "free"
        },
        {
            "id": 7,
            "title": "The Prometheus",
            "author": "Buckley, Theodore Alois, 1825-1856",
            "date": "1899",
            "status": "free"
        },
        {
            "id": 8,
            "title": "Parmenides",
            "author": "Maguire, Thomas, 1831-1889",
            "date": "1882",
            "status": "free"
        },
        {
            "id": 9,
            "title": "Oedipus at Colonus",
            "author": "Jebb, Richard Claverhouse, Sir, 1841-1905",
            "date": "1930",
            "status": "free"
        },
        {
            "id": 10,
            "title": "The Iliad",
            "author": "Bryant, William Cullen, 1794-1878",
            "date": "c1870",
            "status": "free"
        },
        {
            "id": 11,
            "title": "The Prometheus",
            "author": "Buckley, Theodore Alois, 1825-1856",
            "date": "1899",
            "status": "free"
        },
        {
            "id": 12,
            "title": "Parmenides",
            "author": "Maguire, Thomas, 1831-1889",
            "date": "1882",
            "status": "free"
        },
        {
            "id": 13,
            "title": "Oedipus at Colonus",
            "author": "Jebb, Richard Claverhouse, Sir, 1841-1905",
            "date": "1930",
            "status": "free"
        },
        {
            "id": 14,
            "title": "The Iliad",
            "author": "Bryant, William Cullen, 1794-1878",
            "date": "c1870",
            "status": "free"
        },
        {
            "id": 15,
            "title": "The Prometheus",
            "author": "Buckley, Theodore Alois, 1825-1856",
            "date": "1899",
            "status": "free"
        },
        {
            "id": 16,
            "title": "Parmenides",
            "author": "Maguire, Thomas, 1831-1889",
            "date": "1882",
            "status": "free"
        },
        {
            "id": 17,
            "title": "Oedipus at Colonus",
            "author": "Jebb, Richard Claverhouse, Sir, 1841-1905",
            "date": "1930",
            "status": "free"
        },
        {
            "id": 18,
            "title": "The Iliad",
            "author": "Bryant, William Cullen, 1794-1878",
            "date": "c1870",
            "status": "free"
        },
        {
            "id": 19,
            "title": "The Prometheus",
            "author": "Buckley, Theodore Alois, 1825-1856",
            "date": "1899",
            "status": "free"
        },
        {
            "id": 20,
            "title": "Parmenides",
            "author": "Maguire, Thomas, 1831-1889",
            "date": "1882",
            "status": "free"
        },
    ]);

    // This is to go solution
    // useEffect(async() => {
    //     const books = await httpService.get('books');
    //     setBooks(books);
    // }, []);

    // Pagination logic goes here
    const [currentPage, setCurrentPage] = useState(1);
    const booksPerPage = 5;
  
    const handlePageChange = (pageNumber) => {
      setCurrentPage(pageNumber);
    };
  
    const getVisibleBooks = () => {
      const startIndex = (currentPage - 1) * booksPerPage;
      const endIndex = startIndex + booksPerPage;
      return books.slice(startIndex, endIndex);
    };
    // End of pagination logic

    // Update books based on search result
    const handleSearchResults = (newSearchResults) => {
        setBooks(newSearchResults);
    };

    // Toggling book status between Free and Borrow
    const handleBooking = async(bookId, bookStatus) => {
        const url = `/book/${bookId}/${bookStatus === BookStatusType.BORROW ? 'borrowBook' : 'releaseBook'}`;
        const requestBody = { userId: 1 }; // This should get updated to fetch the current user Id

        const borrowResponse = await httpService.put(url, requestBody);
        if (borrowResponse.status === 200) {
            setBooks(books =>
                books.map(book =>
                  book.id === bookId ? { ...book, status: bookStatus } : book
                )
              );
        }
    };
  
    const visibleBooks = getVisibleBooks();


    return ( 
        <div>
            <SearchBar onSearch={ handleSearchResults }/>
            <div className="home">
                <BookList books={ visibleBooks } title='Books' handleBooking={ handleBooking }/>
                <Pagination
                    currentPage={currentPage}
                    totalPages={Math.ceil(books.length / booksPerPage)}
                    handlePageChange={ handlePageChange }
                />
            </div>
        </div>
     );
}
 
export default Home;