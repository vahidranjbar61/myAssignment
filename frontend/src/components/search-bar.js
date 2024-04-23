import { useState } from 'react';
import HttpService from "../services/http";

const SearchBar = ({ onSearch }) => {
  const httpService = new HttpService();
  const [ searchTerm, setSearchTerm ] = useState('');

  const handleChange = async(event) => {
    event.preventDefault(); 
    setSearchTerm(event.target.value);
    
    const searchResult = await httpService.get(`/books/search?searchQuery=${searchTerm}`);
    onSearch(searchResult ?? []);
  };

  return (
    <div className='search-wrapper'>
        <input
            id="search"
            className='search-input'
            type="text"
            value={ searchTerm }
            onChange={ handleChange }
            placeholder="Enter your search term"
        />
    </div>
  );
};

export default SearchBar;
